<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Owners\OwnerProduct;
use App\Models\Admin\businesses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $product = OwnerProduct::findOrFail($id);
        Log::info('Tracking product with ID: ' . $id);
        Log::info('Product found: ' . $product->name);
    
        $business = businesses::where('user_id', $product->user_id)->first();
    
        if (!$business) {
            return back()->with('error', 'This product is not associated with any shop.');
        }
    
        if (!$business->latitude || !$business->longitude) {
            Log::info('No coordinates found for business, attempting to geocode fullAddress.');
    
            $address = $business->fullAddress;
            $geocodedCoordinates = $this->geocodeAddress($address);
    
            if ($geocodedCoordinates) {
                $business->latitude = $geocodedCoordinates['latitude'];
                $business->longitude = $geocodedCoordinates['longitude'];
                $business->save();
    
                Log::info('Geocoded coordinates found: Latitude ' . $business->latitude . ', Longitude ' . $business->longitude);
            } else {
                Log::error('Geocoding failed for address: ' . $address);
                return back()->with('error', 'The shop location is unavailable for this product.');
            }
        }
    
        $shopLatLng = [
            'latitude' => $business->latitude,
            'longitude' => $business->longitude,
            'businessName' => $business->businessName,
            'fullAddress' => $business->fullAddress,
            'businessPhone' => $business->businessPhone,
        ];
    
        Log::info('Business found: ' . $business->businessName);
        Log::info('Coordinates: Latitude ' . $business->latitude . ', Longitude ' . $business->longitude);
    
        return view('users.map.map', compact('product', 'shopLatLng'));
    }
    
    
    /**
     * Geocode the address using Google Maps API or another service.
     */
    private function geocodeAddress($address)
    {
        $apiKey = '5dca11cbb6ba412a97c4a65d4d277790'; 
        $url = "https://api.opencagedata.com/geocode/v1/json?q=" . urlencode($address) . "&key=" . $apiKey;
    
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);  
    
        $response = curl_exec($ch);
    
        if ($response === false) {
            $error = curl_error($ch);
            Log::error('cURL error: ' . $error);
            curl_close($ch);
            return null;
        }
    
        curl_close($ch);
    
        $json = json_decode($response, true);
    
        Log::info('Geocoding response for address: ' . $address);
        Log::info('API Response: ' . json_encode($json));
    
        if (!empty($json['results'])) {
            $latitude = $json['results'][0]['geometry']['lat'];
            $longitude = $json['results'][0]['geometry']['lng'];
    
            return [
                'latitude' => $latitude,
                'longitude' => $longitude,
            ];
        }
    
        return null;  
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
