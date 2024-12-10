<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owners\OwnerProduct;
use App\Models\Admin\businesses;
use App\Models\Users\shopfeedback;

class LandingPageController extends Controller
{
    public function index()
    {
        // Retrieve all active products (not archived)
        $products = OwnerProduct::whereNull('archived_at')->paginate(10);
    
        // Retrieve top 3 shops based on view count
        $topShops = businesses::orderBy('view_count', 'desc')->take(3)->get();
    
        // Retrieve businesses with pagination
        $businesses = businesses::paginate(6);
    
        // Calculate average ratings for each business
        foreach ($businesses as $business) {
            $feedbacks = shopfeedback::where('business_id', $business->id)->get(); // Use business->id here
            $business->averageRating = $feedbacks->avg('rating'); // Calculate the average rating for the current business
        }
    
        // Return the landing page view with products, top shops, businesses, and average ratings
        return view('welcome', compact('products', 'topShops', 'businesses'));
    }
    

    public function show(string $id)
    {
        $products = OwnerProduct::all();
        $products = OwnerProduct::with('user')->findOrFail($id);

        return view('users.products.productview', compact('products'));
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

        $topShops = businesses::orderBy('view_count', 'desc')->take(3)->get();
        // Return the search results view with products
        return view('welcome', compact('products', 'query','topShops'));
    }

    public function about()
    {
        return view('about');  // Return the about view
    }
}
