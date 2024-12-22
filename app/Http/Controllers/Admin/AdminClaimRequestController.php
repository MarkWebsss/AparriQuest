<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Owners\ClaimRequest;
use App\Models\Admin\businesses;
use Illuminate\Http\Request;
use App\Notifications\ClaimRequestApprovedNotification;
use App\Notifications\ClaimRequestRejectedNotification;
use App\Models\ShopRegistration;

class AdminClaimRequestController extends Controller
{
    public function index()
    {
        // Get all claim requests with 'Pending' status
        $claimRequests = ClaimRequest::where('status', 'Pending')->get();

        $shops = ShopRegistration::paginate(5);

        return view('admin.claim-requests.index', compact('claimRequests', 'shops'));
    }

    // Show details of a specific claim request
    public function show(ClaimRequest $claimRequest)
    {
        return view('admin.claim-requests.show', compact('claimRequest'));
    }

    public function approve(ClaimRequest $claimRequest)
    {
        // Update the claim request status to 'Approved' and set the approved_by field
        $claimRequest->update([
            'status' => 'Approved',
            'approved_by' => auth()->id(),  // Set the currently authenticated admin as the approver
        ]);
    
        // Update the business status to 'Claimed'
        $business = $claimRequest->business;
        $business->update(['status' => 'Claimed', 'user_id' => $claimRequest->user_id]);
    
        // Notify the owner that their claim request was approved
        $claimRequest->user->notify(new ClaimRequestApprovedNotification($claimRequest));
    
        return redirect()->route('admin.claim-requests.index')->with('success', 'Claim request approved successfully.');
    }
    
    

    public function reject(ClaimRequest $claimRequest)
    {
        // Update the claim request status to 'Rejected'
        $claimRequest->update(['status' => 'Rejected']);

        // Notify the owner that their claim request was rejected
        $claimRequest->user->notify(new ClaimRequestRejectedNotification($claimRequest));

        return redirect()->route('admin.claim-requests.index')->with('error', 'Claim request rejected.');
    }
}
