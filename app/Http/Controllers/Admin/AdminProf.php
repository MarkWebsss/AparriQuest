<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User; // Make sure this is included

class AdminProf extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Fill the validated data
        $request->user()->fill($request->validated());

        // Check if the email was changed
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Handle photo upload if a file is provided
        if ($request->hasFile('photo')) {
            // Validate the photo input
            $request->validate([
                'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max file size: 2MB
            ]);

            // Delete old profile photo if exists
            if ($request->user()->profile_photo) {
                Storage::delete('public/' . $request->user()->profile_photo);
            }

            // Store the new photo
            $path = $request->file('photo')->store('profile_photos', 'public');

            // Update the user's profile_photo field with the new path
            $request->user()->profile_photo = $path;
        }

        // Save the user's updated information
        $request->user()->save();

        // Redirect back to the profile edit page with a success message
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
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
