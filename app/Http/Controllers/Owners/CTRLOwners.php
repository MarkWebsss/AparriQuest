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
use App\Models\Owners\ClaimRequest;
use App\Notifications\NewClaimRequestNotification;
Use App\Models\User;
use App\Models\Role;

class CTRLOwners extends Controller
{
    /**
     * Display the owner's claimed business.
     */
    public function index()
    {
        $userId = Auth::id();
        
        // Get all unread notifications for the authenticated user
        $notifications = Auth::user()->unreadNotifications;
    
        // Other dashboard data
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
    
        if ($business) {
            $feedbacks = $business->feedback; 
            $averageRating = $feedbacks->avg('rating');
            $business->update(['last_viewed_at' => now()]);
        } else {
            $feedbacks = collect(); // Default to an empty collection
            $averageRating = null;
        }
    
        // Pass the notifications along with other variables to the view
        return view('owner.dashboard', compact(
            'business', 
            'productCount', 
            'availableStockCount', 
            'outOfStockCount', 
            'viewCount', 
            'feedbacks', 
            'averageRating',
            'notifications'
        ));
    }
    
    /**
     * Method to fetch shop views data for the owner's dashboard graph.
     */
    public function getShopViewsGraphData(Request $request)
    {
        $userId = Auth::id(); // Get the logged-in user ID
        $business = businesses::where('user_id', $userId)
            ->where('status', 'Claimed')
            ->first();
    
        if (!$business) {
            return response()->json(['error' => 'No business found'], 404);
        }
    
        // Get the selected month from the request, or default to the last 30 days if not provided
        $month = $request->input('month', 'all');

        // Define the start and end dates based on the selected month
        if ($month !== 'all') {
            // Get the start and end dates of the selected month
            $startDate = Carbon::createFromFormat('Y-m', Carbon::now()->year . '-' . $month)->startOfMonth();
            $endDate = $startDate->copy()->endOfMonth();
        } else {
            // Default to the last 30 days
            $startDate = Carbon::now()->subDays(30)->startOfDay();
            $endDate = Carbon::now()->endOfDay();
        }
    
        // Fetch daily views for the shop within the selected date range
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
            'tin_number' => 'required|exists:businesses,tin_number',
        ]);

        $business = businesses::where('tin_number', $request->tin_number)
                                ->where('status', 'Unclaimed')
                                ->first();

        if ($business) {
            Log::info("Business found: ", ['id' => $business->businessName]);

            $updateResult = $business->update([
                'status' => 'Claimed',
                'user_id' => auth()->id(),
            ]);

            Log::info("Business update result: ", ['result' => $updateResult]);
            Log::info("Claimed Business: ", [$business]);

            return redirect()->route('owner.dashboard')->with('success', 'Shop claimed successfully!');
        }

        return back()->withErrors(['tin_number' => 'Shop not found or shop already claimed']);
    }

    public function showClaimForm()
    {
        return view('owner.claim');
    }

    
    public function submitClaimRequest(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'tin_number' => 'required|string',
            'proof_of_ownership' => 'required|file|mimes:jpeg,png,pdf|max:2048', // Adjust validation rules as necessary
        ]);
    
        // Retrieve the `tin_number` from the request
        $tin_number = trim(strtolower($request->tin_number));
    
        // Query the `businesses` table to find a match
        $business = businesses::whereRaw('LOWER(tin_number) = ?', [$tin_number])
            ->whereIn('status', ['Unclaimed', 'Pending']) // Only consider eligible businesses
            ->first();
    
        // Check if the business exists and is eligible
        if (!$business) {
            return back()->withErrors(['tin_number' => 'Shop not found or not eligible for claim.']);
        }
    
        // Handle the proof of ownership file upload
        $filePath = $request->file('proof_of_ownership')->store('proofs', 'public');
    
        // Create a new claim request and associate it with the business
        $claimRequest = ClaimRequest::create([
            'user_id' => Auth::id(),  // Associate with the current user
            'business_id' => $business->id, // Link the claim request to the business
            'status' => 'Pending',  // Default status for admin review
            'proof_of_ownership' => $filePath,  // Save the file path for the proof
        ]);
    
        // Notify the admin about the new claim request
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $admin = $adminRole->users()->first(); // Get the first admin user
            if ($admin) {
                $admin->notify(new NewClaimRequestNotification($claimRequest));
            }
        }
    
        // Redirect to the owner dashboard with a success message
        return redirect()->route('owner.dashboard')->with('success', 'Claim request submitted successfully. Wait for admin approval.');
    }
    

    public function rejectClaimRequest(ClaimRequest $claimRequest)
    {
        // Update the status of the claim request to 'Rejected'
        $claimRequest->update(['status' => 'Rejected']);

        // Optional: Send a notification to the owner (if you have a Notification system)
        // $claimRequest->user->notify(new ClaimRequestRejectedNotification($claimRequest));

        // Return to the claim requests list with a success message
        return redirect()->route('admin.claim-requests.index')
                         ->with('error', 'Claim request rejected and the shop owner has been notified.');
    }

    public function approveClaimRequest(ClaimRequest $claimRequest)
    {
        // Update the status of the claim request to 'Approved'
        $claimRequest->update(['status' => 'Approved']);

        // Optional: Send a notification to the owner
        // $claimRequest->user->notify(new ClaimRequestApprovedNotification($claimRequest));

        return redirect()->route('admin.claim-requests.index')
                         ->with('success', 'Claim request approved successfully.');
    }

    public function markAllAsRead()
    {
        // Get the authenticated user
        $user = Auth::user();
    
        // Mark all unread notifications as read
        $user->unreadNotifications->markAsRead();
    
        // Return the updated unread notification count
        return response()->json([
            'unreadCount' => $user->unreadNotifications->count(),
        ]);
    }
}
