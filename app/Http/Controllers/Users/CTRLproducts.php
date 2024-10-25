<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owners\OwnerProduct;

class CTRLproducts extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            
        // Retrieve all products from OwnerProduct model
        $products = OwnerProduct::all();
        $products = OwnerProduct::with('user')->get();

        // Return the landing page view with products
        return view('users.products.index', compact('products'));
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
        $products = OwnerProduct::all();
        $products = OwnerProduct::with('user')->findOrFail($id);
        return view('users.products.productview', compact('products'));
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

    // my search function goes here 
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
        return view('users.products.searchresults', compact('products', 'query'));
    }
}
