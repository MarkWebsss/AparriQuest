<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Owners\OwnerProduct;
use App\Models\Admin\businesses;
use App\Models\Owners\shopviews;
use App\Models\Users\shopfeedback;

class CTRLproducts extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $business = businesses::first();
        
        $products = OwnerProduct::whereNull('archived_at')->get();

        $feedbacks = shopfeedback::where('business_id', $business->id)->get();
        $averageRating = $feedbacks->avg('rating');

        return view('users.products.index', compact('products', 'business','averageRating'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        $business = $user->business; 
    
        if (!$business) {
            return redirect()->route('products.index')->with('error', 'You must claim a shop before adding products.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $product = new OwnerProduct();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->status = $request->input('status');
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        } else {
            $product->image = 'logo/NOIMAGE.png'; 
        }
    
        $product->user_id = $user->id;
        $product->business_id = $business->id; 
    
        $product->save(); 
    
        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = OwnerProduct::with(['user.business'])->findOrFail($id);
        $business = $product->user->business ?? null;
    
        return view('users.products.productview', compact('product', 'business'));
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

public function search(Request $request)
{
    // Get the search query input from the user
    $query = $request->input('query');
    $sort = $request->input('sort');

    // Initialize the query for businesses
    $shops = businesses::query();

    // If the user has entered a search query, filter by shop name
    if (!empty($query)) {
        $shops = $shops->where('businessName', 'like', '%' . $query . '%');
    }

    // Apply sorting based on user's selection
    switch ($sort) {
        case 'newest':
            $shops->orderBy('created_at', 'desc');
            break;
        case 'oldest':
            $shops->orderBy('created_at', 'asc');
            break;
        default:
            $shops->orderBy('id', 'asc');
            break;
    }

    // Fetch the results
    $shops = $shops->get();

    // Calculate the average rating for each shop
    foreach ($shops as $shop) {
        $feedbacks = shopfeedback::where('business_id', $shop->id)->get();
        $shop->averageRating = $feedbacks->avg('rating') ?? 'No ratings yet';
    }

    // Return the search results view
    return view('users.products.searchresults', compact('shops', 'query'));
}

    
    public function searchproducts(Request $request)
    {
        // Get the search query input from the user
    $query = $request->input('query'); 

    // Initialize the query to fetch products
    $products = OwnerProduct::query();

    // Check if a query was entered
    if (!empty($query)) {
        // Search in the 'name' and 'description' columns using 'like' to allow for partial matching
        $products = $products->where(function($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%' . $query . '%')
                         ->orWhere('description', 'like', '%' . $query . '%');
        });
    }

    // Fetch the products from the database
    $products = $products->get();
        // Return the search results view with products
        return view('users.products.index', compact('products', 'query'));
    }
}
