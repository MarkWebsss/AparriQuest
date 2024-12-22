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

    public function business(string $id)
    {
        // Fetch the specific business by its id
        $business = businesses::findOrFail($id);
    
        // Pass the data to the view
        return view('index', compact('business'));
    }
    

    public function search(Request $request)
    {
        // Validate the search query
        $request->validate([
            'query' => 'required|string|max:255',
        ]);
    
        // Retrieve the search query
        $query = $request->input('query');
    
        // Search for shops in businesses model
        $shops = businesses::where('businessName', 'LIKE', "%{$query}%")
            ->paginate(6); // Paginate the results (6 shops per page)
    
        // Retrieve top 3 shops based on view count
        $topShops = businesses::orderBy('view_count', 'desc')->take(3)->get();

        $products = OwnerProduct::whereNull('archived_at')->paginate(10);

        $businesses = businesses::paginate(6);

        foreach ($shops as $shop) {
            // Check if there are feedbacks and calculate average
            $shop->averageRating = $shop->feedback->isEmpty() ? 'No ratings yet' : $shop->feedback->avg('rating');
        }
        
        // Return the search results view with shops
        return view('search', compact('shops', 'query', 'topShops', 'products', 'businesses'));
    }

    public function shop()
    {
        $shops = businesses::paginate(6);

        foreach ($shops as $shop) {
            // Check if there are feedbacks and calculate average
            $shop->averageRating = $shop->feedback->isEmpty() ? 'No ratings yet' : $shop->feedback->avg('rating');
        }
        
        return view('search', compact('shops'));  
    }
}
