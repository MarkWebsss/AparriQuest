<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Owners\OwnerProduct;
use App\Models\Admin\businesses;
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.map.map');
    }

    public function trackProduct($id)
    {
        // Fetch the product by its ID
        $product = OwnerProduct::findOrFail($id);
        \Log::info('Tracking product with ID: ' . $id);
        \Log::info('Product found: ' . $product->name);
    
        // Fetch the business using the user_id (owner) of the product
        $business = businesses::where('user_id', $product->user_id)->first();
    
        // Check if the business exists
        if (!$business) {
            return back()->with('error', 'This product is not associated with any shop.');
        }
    
        // If the business has no latitude and longitude, geocode the fullAddress
        if (!$business->latitude || !$business->longitude) {
            \Log::info('No coordinates found for business, attempting to geocode fullAddress.');
    
            // Using the fullAddress field for geocoding
            $address = $business->fullAddress;
            $geocodedCoordinates = $this->geocodeAddress($address);
    
            if ($geocodedCoordinates) {
                // Update the business with the geocoded latitude and longitude
                $business->latitude = $geocodedCoordinates['latitude'];
                $business->longitude = $geocodedCoordinates['longitude'];
                $business->save();
    
                \Log::info('Geocoded coordinates found: Latitude ' . $business->latitude . ', Longitude ' . $business->longitude);
            } else {
                \Log::error('Geocoding failed for address: ' . $address);
                return back()->with('error', 'The shop location is unavailable for this product.');
            }
        }
    
        // Get the shop's lat/lng coordinates and other details
        $shopLatLng = [
            'latitude' => $business->latitude,
            'longitude' => $business->longitude,
            'businessName' => $business->businessName,
            'fullAddress' => $business->fullAddress,
            'businessPhone' => $business->businessPhone,
        ];
    
        \Log::info('Business found: ' . $business->name);
        \Log::info('Coordinates: Latitude ' . $business->latitude . ', Longitude ' . $business->longitude);
    
        // Return the product and shop location to the map view
        return view('users.map.map', compact('product', 'shopLatLng'));
    }
    
    
    /**
     * Geocode the address using Google Maps API or another service.
     */
    private function geocodeAddress($address)
    {
        $apiKey = '5dca11cbb6ba412a97c4a65d4d277790';  // Replace with your OpenCage API key
        $url = "https://api.opencagedata.com/geocode/v1/json?q=" . urlencode($address) . "&key=" . $apiKey;
    
        // Initialize cURL session
        $ch = curl_init();
    
        // Set the URL and options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);  // Set a timeout for the request
    
        // Execute the request
        $response = curl_exec($ch);
    
        // Check for cURL errors
        if ($response === false) {
            $error = curl_error($ch);
            \Log::error('cURL error: ' . $error);
            curl_close($ch);
            return null;
        }
    
        // Close the cURL session
        curl_close($ch);
    
        // Decode the JSON response
        $json = json_decode($response, true);
    
        // Log the response for debugging
        \Log::info('Geocoding response for address: ' . $address);
        \Log::info('API Response: ' . json_encode($json));
    
        // Return coordinates if found
        if (!empty($json['results'])) {
            $latitude = $json['results'][0]['geometry']['lat'];
            $longitude = $json['results'][0]['geometry']['lng'];
    
            return [
                'latitude' => $latitude,
                'longitude' => $longitude,
            ];
        }
    
        return null;  // If geocoding fails, return null
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
