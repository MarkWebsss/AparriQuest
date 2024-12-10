<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Owners\OwnerProduct;
use App\Models\Admin\businesses;
use App\Models\Owners\shopviews;
use App\Models\Users\shopfeedback; // Import shopfeedback model
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index()
    {
        $business = session('business');

        if ($business) {
            $products = OwnerProduct::where('user_id', $business->user_id)
                ->whereNull('archived_at')
                ->get();
            
            // Fetch the feedbacks for the business (shop) and calculate the average rating
            $feedbacks = shopfeedback::where('business_id', $business->id)->get(); // Assuming shopfeedback has a 'shop_id' foreign key
            $averageRating = $feedbacks->avg('rating'); // Calculate the average rating
        } else {
            $products = collect(); 
            $averageRating = 0; // Default value if no feedbacks
        }

        return view('users.business.index', compact('business', 'products', 'averageRating'));
    }

    public function show($id)
    {
        $business = businesses::findOrFail($id);
    
        $business->increment('view_count');
    
        $userId = Auth::check() ? Auth::id() : null;
    
        shopviews::create([
            'shop_id' => $business->id,
            'user_id' => $userId,
            'viewed_at' => now(),
        ]);
    
        session()->put('business', $business);
    
        return redirect()->route('users.shop.index');
    }
}
