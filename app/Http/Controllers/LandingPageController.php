<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owners\OwnerProduct;

class LandingPageController extends Controller
{
    public function index()
    {
        // Retrieve all products from OwnerProduct model
        $products = OwnerProduct::all();

        // Return the landing page view with products
        return view('welcome', compact('products'));
    }

    public function search(Request $request)
    {
        // Validate the search query
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        // Retrieve the search query
        $query = $request->input('query');

        // Search for products in OwnerProduct model
        $products = OwnerProduct::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        // Return the search results view with products
        return view('welcome', compact('products', 'query'));
    }
}
