<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

use App\Models\Admin\adminLog;
use App\Models\Admin\businesses;
use App\Models\User;

class CTRLbusiness extends Controller
{
    public function index()
    {
        $businesses = businesses::paginate(5);
        return view('admin.users.business.index', compact('businesses'));
    }

    public function create()
    {
        // Implement your create method logic
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255', // Nullable middle name
            'lastName' => 'required|string|max:255',
            'ownerHouseNo' => 'required|string|max:255',
            'ownerStreetAddress' => 'required|string|max:255',
            'ownerCity' => 'required|string|max:255',
            'ownerEmail' => 'required|email|max:255',
            'ownerPhone' => 'required|string|max:15',
            'dateOfApplication' => 'required|date',
            'businessName' => 'required|string|max:255',
            'tinNumber' => 'required|string|max:255',
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
        $fullAddress = trim($validatedData['ownerHouseNo'] . ', ' . $validatedData['ownerStreetAddress'] . ', ' . $validatedData['ownerCity']);
        $business->fullAddress = $fullAddress;

        // Assign other request data to the business model
        $business->ownerEmail = $validatedData['ownerEmail'];
        $business->ownerPhone = $validatedData['ownerPhone'];
        $business->dateOfApplication = $validatedData['dateOfApplication'];
        $business->businessName = $validatedData['businessName'];
        $business->tinNumber = $validatedData['tinNumber'];
        $business->businessNo = $validatedData['businessNo'];
        $business->BusStreetAddress = $validatedData['BusStreetAddress'];
        $business->businessCity = $validatedData['businessCity'];
        $business->businessEmail = $validatedData['businessEmail'];
        $business->businessPhone = $validatedData['businessPhone'];

        // Save the business to the database
        $business->save();

        // Redirect or return a response
        return redirect()->route('business.index')->with('success', 'Business registered successfully.');
    }


    public function show(string $id)
    {
        // Implement your show method logic
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

        
        $results = businesses::where('tinNumber',  $query)->get();
    
        
        if ($results->isNotEmpty()) {
            return view('admin.users.business.shopsearch', compact('results'));
        }
    
        
        $businesses = businesses::paginate(5); 
        return view('admin.users.business.shopsearch', compact('businesses'));
    }
}
