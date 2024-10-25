<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\NewUserRequest;

class UserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function restrictedPage()
    {
        return view('users.restricted-page');  // The path to your restricted Blade view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.request-confirmation');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'proofFiles' => 'file|mimes:jpg,jpeg,png,gif,pdf|max:2048', // Adjust validation as needed
        ]);

        $filePath = null;
        if ($request->hasFile('proofFiles')) {
            $filePath = $request->file('proofFiles')->store('proof_files', 'public');
        }

        $userRequest = UserRequest::create([
            'user_id' => auth()->id(),
            'description' => $request->input('description'),
            'file' => $filePath,
        ]);

        return redirect()->route('users.requests.create')->with('success', 'Request submitted successfully. Please wait within the day for confirmation.');
    }

    private function getAdminUser()
    {
        return User::where('id', true)->first(); // Adjust this based on your application's admin identification logic
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
