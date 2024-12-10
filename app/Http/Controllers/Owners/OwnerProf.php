<?php
namespace App\Http\Controllers\Owners;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Admin\businesses;

class OwnerProf extends Controller
{
    public function index()
    {
        return view('owner.businessprofile.business');
    }
    public function edit(Request $request): View
    {
        return view('profile.ownerprof', [
            'user' => $request->user(),
        ]);
    }
    
    public function feedback(Request $request): View
    {
        $user = $request->user();
        
        // Fetch the business related to the logged-in user
        $business = businesses::where('user_id', $user->id)->first();
        
        // If no business is found, redirect to the dashboard with an error message
        if (!$business) {
            return view('owner.feedback.usersfeedback', compact('business'))->with('error', 'No business found for this user.');
        }
        
        // Fetch all feedback related to the business
        $feedbacks = $business->feedback()->get();
        
        // Group feedback by rating
        $ratingsGrouped = [
            1 => $feedbacks->where('rating', 1),
            2 => $feedbacks->where('rating', 2),
            3 => $feedbacks->where('rating', 3),
            4 => $feedbacks->where('rating', 4),
            5 => $feedbacks->where('rating', 5),
        ];
        
        // Return the view with the feedback data
        return view('owner.feedback.usersfeedback', [
            'user' => $user,
            'business' => $business,
            'feedbacks' => $feedbacks,
            'ratingsGrouped' => $ratingsGrouped,
        ]);
    }    
    
    public function shopfeedback($businessId)
    {
        $business = businesses::findOrFail($businessId);
    
        // Get all feedbacks for the business
        $feedbacks = $business->feedbacks()->get();
    

        return view('owner.dashboard', compact('business', 'feedbacks'));
    }
    

    public function shopedit($id)
    {
        $business = businesses::find($id);

        // Ensure the business exists
        if (!$business) {
            return redirect()->back()->with('error', 'Business not found.');
        }
    
        return view('owner.businessprofile.business', compact('business'));
    }    

    public function updateLogo(Request $request, $id)
    {
        $business = businesses::find($id);
    
        if (!$business) {
            return redirect()->back()->with('error', 'Business not found.');
        }
    
        // Validate and upload the logo
        $request->validate([
            'shopLogo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('shopLogo')) {
            $file = $request->file('shopLogo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public', $filename);
    
            // Update the business logo
            $business->shopLogo = $filename;
            $business->save();
        }
    
        // Redirect to the profile page with a success message
        return redirect()->route('owner.business.edit', ['id' => $business->id])
            ->with('status', 'Logo updated successfully!');
    }
    
    

    public function shopupdate(Request $request, $id)
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'lastName' => 'required|string|max:255',
            'ownerHouseNo' => 'required|string|max:255',
            'ownerStreetAddress' => 'required|string|max:255',
            'ownerCity' => 'required|string|max:255',
            'ownerEmail' => 'required|email|max:255',
            'ownerPhone' => 'required|string|max:15',
            'dateOfApplication' => 'required|date',
            'businessName' => 'required|string|max:255',
            'tinNumber' => 'required|string|max:255',
            'businessNo' => 'required|string|max:255',
            'BusStreetAddress' => 'required|string|max:255',
            'businessCity' => 'required|string|max:255',
            'businessEmail' => 'required|email|max:255',
            'businessPhone' => 'required|string|max:15',
        ]);
    
        // Find the business by ID
        $business = businesses::findOrFail($id);
    
        // Update the business information
        $business->firstName = $request->firstName;
        $business->middleName = $request->middleName;
        $business->lastName = $request->lastName;
        $business->ownerHouseNo = $request->ownerHouseNo;
        $business->ownerStreetAddress = $request->ownerStreetAddress;
        $business->ownerCity = $request->ownerCity;
        $business->ownerEmail = $request->ownerEmail;
        $business->ownerPhone = $request->ownerPhone;
        $business->dateOfApplication = $request->dateOfApplication;
        $business->businessName = $request->businessName;
        $business->tinNumber = $request->tinNumber;
        $business->businessNo = $request->businessNo;
        $business->BusStreetAddress = $request->BusStreetAddress;
        $business->businessCity = $request->businessCity;
        $business->businessEmail = $request->businessEmail;
        $business->businessPhone = $request->businessPhone;
    
        // Save the updated business information
        $business->save();
    
        // Redirect with a success message
        return redirect()->route('business.edit', ['id' => $id])->with('success', 'Shop Updated.');
    }

    // Update the user's profile information.
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
    
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
    
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);
    
            if ($request->user()->profile_photo) {
                Storage::delete('public/' . $request->user()->profile_photo);
            }
    
            $path = $request->file('photo')->store('profile_photos', 'public');
    
            $request->user()->profile_photo = $path;
        }
    
        $request->user()->save();
    
        return Redirect::route('owner.dashboard')->with('status', 'Profile updated successfully!');
    }
    
    // Delete the user's account.
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
