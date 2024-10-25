<?php

namespace App\Http\Controllers\Owners;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Admin\businesses;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CTRLOwners extends Controller
{
    /**
     * Display the owner's claimed business.
     */
    public function index()
    {
        $userId = Auth::id(); // Get the logged-in user's ID

        // Query to find the business claimed by the current user
        $business = businesses::where('user_id', $userId)
                                ->where('status', 'Claimed')
                                ->first();

        // Always pass $business (even if it's null)
        return view('owner.dashboard')->with('business', $business);
    }   

    public function claimShop(Request $request)
{
    // Validate the TIN number
    $request->validate([
        'tinNumber' => 'required|exists:businesses,tinNumber',
    ]);

    // Find the business that is still unclaimed
    $business = businesses::where('tinNumber', $request->tinNumber)
                            ->where('status', 'Unclaimed')
                            ->first();

    // If no unclaimed business found, return an error
    if ($business) {
        // Log that we found the business
        \Log::info("Business found: ", ['id' => $business->id]);

        // Attempt to update the business to mark it as claimed
        $updateResult = $business->update([
            'status' => 'Claimed',
            'user_id' => auth()->id(),
        ]);

        // Log if the update was successful or not
        \Log::info("Business update result: ", ['result' => $updateResult]);
        \Log::info("Claimed Business: ", [$business]);

        // Redirect to the owner's dashboard with the claimed shop info
        return redirect()->route('owner.dashboard')->with('success', 'Shop claimed successfully!');
    }

    // Redirect back with an error if the TIN number doesn't match or is already claimed
    return back()->withErrors(['tinNumber' => 'TIN number not found or shop already claimed']);
}
}
