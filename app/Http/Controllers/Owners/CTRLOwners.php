<?php

namespace App\Http\Controllers\Owners;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Admin\businesses;
use App\Models\Owners\OwnerProduct;
use App\Models\Owners\ShopViews;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CTRLOwners extends Controller
{
    /**
     * Display the owner's claimed business.
     */
    public function index()
    {
        $userId = Auth::id();
    
        $productCount = OwnerProduct::where('user_id', $userId)->count();
        $availableStockCount = OwnerProduct::where('user_id', $userId)
            ->where('status', 'Available')
            ->count();
        $outOfStockCount = OwnerProduct::where('user_id', $userId)
            ->where('status', 'Out of Stock')
            ->count();
    
        $business = businesses::where('user_id', $userId)
            ->where('status', 'Claimed')
            ->first();
    
        $viewCount = $business ? $business->view_count : 0;
    
        // Check if $business exists before accessing related properties
        if ($business) {
            $feedbacks = $business->feedback; 
            $averageRating = $feedbacks->avg('rating');
            $business->update(['last_viewed_at' => now()]);
        } else {
            $feedbacks = collect(); // Default to an empty collection
            $averageRating = null;
        }
    
        return view('owner.dashboard', compact(
            'business', 
            'productCount', 
            'availableStockCount', 
            'outOfStockCount', 
            'viewCount', 
            'feedbacks', 
            'averageRating'
        ));
    }
    

    /**
     * Method to fetch shop views data for the owner's dashboard graph.
     */
    public function getShopViewsGraphData()
    {
        $userId = Auth::id(); // Get the logged-in user ID
        $business = businesses::where('user_id', $userId)
            ->where('status', 'Claimed')
            ->first();

        if (!$business) {
            return response()->json(['error' => 'No business found'], 404);
        }

        // Define the start and end dates (e.g., past 30 days)
        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        // Fetch daily views for the shop
        $viewsData = DB::table('shopviews')
            ->selectRaw('DATE(viewed_at) as view_date, COUNT(*) as views')
            ->where('shop_id', $business->id)
            ->whereBetween('viewed_at', [$startDate, $endDate])
            ->groupBy('view_date')
            ->orderBy('view_date', 'asc')
            ->get();

        // Generate an array of all days in the date range
        $allDays = collect();
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $allDays->push($date->format('Y-m-d'));
        }

        // Map the fetched data to a complete dataset, filling missing days with 0 views
        $dailyViews = $allDays->mapWithKeys(function ($day) use ($viewsData) {
            $viewForDay = $viewsData->firstWhere('view_date', $day);
            return [$day => $viewForDay ? $viewForDay->views : 0];
        });

        // Prepare data for the chart
        $timestamps = $dailyViews->keys(); // Dates (x-axis)
        $viewCounts = $dailyViews->values(); // Views per day (y-axis)

        return response()->json([
            'timestamps' => $timestamps,
            'viewCounts' => $viewCounts,
        ]);
    }

    /**
     * Method to claim a shop for the owner.
     */
    public function claimShop(Request $request)
    {
        $request->validate([
            'businessName' => 'required|exists:businesses,businessName',
        ]);

        $business = businesses::where('businessName', $request->businessName)
                                ->where('status', 'Unclaimed')
                                ->first();

        if ($business) {
            Log::info("Business found: ", ['id' => $business->id]);

            $updateResult = $business->update([
                'status' => 'Claimed',
                'user_id' => auth()->id(),
            ]);

            Log::info("Business update result: ", ['result' => $updateResult]);
            Log::info("Claimed Business: ", [$business]);

            return redirect()->route('owner.dashboard')->with('success', 'Shop claimed successfully!');
        }

        return back()->withErrors(['businessName' => 'Shop not found or shop already claimed']);
    }
}
