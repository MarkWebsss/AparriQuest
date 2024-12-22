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
        
        $products = OwnerProduct::whereNull('archived_at')->paginate(8);

        $feedbacks = shopfeedback::where('business_id', $business->id)->get();
        $averageRating = $feedbacks->avg('rating');

        $categories = OwnerProduct::pluck('category')->unique();

        return view('users.products.index', compact('products', 'business','averageRating','categories'));
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
    $query = $request->input('query');
    $category = $request->input('category');
    $sort = $request->input('sort');
    $minPrice = $request->input('min_price');
    $maxPrice = $request->input('max_price');

    // Initialize the query for products (from the 'owner_products' table)
    $products = OwnerProduct::query();

    if (!empty($query)) {
        $products = $products->where('name', 'like', '%' . $query . '%')
                             ->orWhere('description', 'like', '%' . $query . '%');
    }

    if (!empty($category)) {
        $products = $products->where('category', $category); // Assuming 'category' is the column in owner_products table
    }

    // Apply price filtering if min and/or max prices are set
    if (!empty($minPrice)) {
        $products = $products->where('price', '>=', $minPrice);
    }

    if (!empty($maxPrice)) {
        $products = $products->where('price', '<=', $maxPrice);
    }

    // Sorting
    switch ($sort) {
        case 'newest':
            $products->orderBy('created_at', 'desc');
            break;
        case 'oldest':
            $products->orderBy('created_at', 'asc');
            break;
        case 'price_asc':
            $products->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $products->orderBy('price', 'desc');
            break;
        default:
            $products->orderBy('id', 'asc');
            break;
    }

    // Get all products
    $products = $products->paginate(8);

    // Get categories
    $categories = OwnerProduct::pluck('category')->unique();

    return view('users.products.productresult', compact('products', 'query', 'categories', 'minPrice', 'maxPrice'));
}


public function allsearch(Request $request)
{
    $query = $request->input('query');

    // Search in businesses table
    $shops = businesses::where('businessName', 'LIKE', "%$query%")
        ->orWhere('fullAddress', 'LIKE', "%$query%")
        ->orWhere('businessEmail', 'LIKE', "%$query%")
        ->get();

    // Search in products table
    $products = OwnerProduct::where('name', 'LIKE', "%$query%")
        ->orWhere('description', 'LIKE', "%$query%")
        ->orWhere('category', 'LIKE', "%$query%")
        ->get();

    return view('users.results', compact('shops', 'products', 'query'));
}
}
