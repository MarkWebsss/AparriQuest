<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Admin\adminLog;
use App\Models\Admin\businesses;
use App\Models\User;
use Carbon\Carbon;
use App\Models\ShopRegistration;

class CTRLbusiness extends Controller
{
    public function index()
    {
        $businesses = businesses::paginate(5);
        $shops = ShopRegistration::paginate(5);
        return view('admin.users.business.index', compact('businesses', 'shops'));
    }

    public function create()
    {
        // Implement your create method logic
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255', 
            'lastName' => 'required|string|max:255',
            'ownerHouseNo' => 'required|string|max:255',
            'ownerStreetAddress' => 'required|string|max:255',
            'ownerCity' => 'required|string|max:255',
            'ownerEmail' => 'required|email|max:255',
            'ownerPhone' => 'required|string|max:15',
            'tin_number' => 'required|string|max:265',
            'businessName' => 'required|string|max:255',
            'businessNo' => 'required|string|max:255',
            'BusStreetAddress' => 'required|string|max:255',
            'businessCity' => 'required|string|max:255',
            'businessEmail' => 'required|email|max:255',
            'businessPhone' => 'required|string|max:15',
        ]);

        // Combine first, middle, and last names into fullName
        $fullName = trim($validatedData['firstName'] . ' ' . ($validatedData['middleName'] ?? '') . ' ' . $validatedData['lastName']);

        // Create a new business instance
        $business = new businesses();
        $business->firstName = $validatedData['firstName'];
        $business->middleName = $validatedData['middleName'];
        $business->lastName = $validatedData['lastName'];
        $business->fullName = $fullName; // Ensure fullName is assigned here

        // Combine address fields into fullAddress
        $fullAddress = trim($validatedData['businessNo'] . ', ' . $validatedData['BusStreetAddress'] . ', ' . $validatedData['businessCity']);

        $business->ownerHouseNo = $validatedData['ownerHouseNo'];
        $business->ownerStreetAddress = $validatedData['ownerStreetAddress'];
        $business->ownerCity = $validatedData['ownerCity'];
        $business->fullAddress = $fullAddress;

        // Assign other request data to the business model
        $business->ownerEmail = $validatedData['ownerEmail'];
        $business->ownerPhone = $validatedData['ownerPhone'];
        $business->tin_number = $validatedData['tin_number'];
        $business->businessName = $validatedData['businessName'];
        $business->businessNo = $validatedData['businessNo'];
        $business->BusStreetAddress = $validatedData['BusStreetAddress'];
        $business->businessCity = $validatedData['businessCity'];
        $business->businessEmail = $validatedData['businessEmail'];
        $business->businessPhone = $validatedData['businessPhone'];

        // Save the business to the database
        try {
            $business->save();
        } catch (\Exception $e) {
            Log::error('Business creation failed', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', $e->getMessage());
        }

        // Redirect or return a response
        return redirect()->route('business.index')->with('success', 'Business registered successfully.');
    }


    public function show(string $id)
    {
        $business = businesses::findOrFail($id);
    
        // Pass the business data to a view called 'admin.users.business.show'
        return view('admin.users.business.show', compact('business'));
    }

    public function edit(string $id)
    {
        // Implement your edit method logic
    }

    public function update(Request $request, string $id)
    {
        // Implement your update method logic
    }

    public function destroy(string $id)
    {
        $store = businesses::find($id);

        if (!$store) {
            return redirect()->route('business.index')->with('error', 'Not Found');
        }

        $store->delete();
        return redirect()->route('business.index')->with('success', 'Store deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        
        $results = businesses::where('tin_number',  $query)->get();
    
        
        if ($results->isNotEmpty()) {
            return view('admin.users.business.shopsearch', compact('results'));
        }
    
        $businesses = businesses::paginate(5); 
        return view('admin.users.business.shopsearch', compact('businesses'));
    }
}
