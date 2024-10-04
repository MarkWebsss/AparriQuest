<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\Admin\businesses;

use DB;
class AdminRequestController extends Controller
{
    public function index()
    {
        $businesses = businesses::all();
        $requests = UserRequest::with('businesses')->where('status', 'pending')->get();

        $confirmedRequests = UserRequest::with('businesses')
            ->where('status', 'confirmed')
            ->paginate(5);

        $declinedRequests = UserRequest::with('businesses')
            ->where('status', 'declined')
            ->paginate(5);

        return view('admin.users.manage-requests', compact('requests', 'businesses', 'confirmedRequests', 'declinedRequests'));
    }

   public function update(Request $request, $id)
    {
    $userRequest = UserRequest::findOrFail($id);

    $request->validate([
        'status' => 'required|in:confirmed,declined'
    ]);
    

    $userRequest->status = $request->input('status');
    $userRequest->save();

    return redirect()->route('admin.manage-requests.index')->with('success', 'Request status updated successfully!');
    }
}

