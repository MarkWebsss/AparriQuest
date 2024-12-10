<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Admin\businesses;
use Illuminate\Http\Request;
use App\Models\Users\shopfeedback;

class ShopFeedbackCTRL extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $business = businesses::first(); // Fetch the first business as an example
    
        return view('users.feedback.shopfeedback', compact('business'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'message' => 'required|string|max:1000',
            'rating' => 'nullable|integer|between:1,5',
        ]);
    
        shopfeedback::create([
            'user_id' => auth()->id(),
            'business_id' => $request->business_id,
            'message' => $request->message,
            'rating' => $request->rating,  
        ]);
    
        return redirect()->back()->with('success', 'Your feedback has been submitted successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $business = businesses::with('feedback.user')->findOrFail($id);
    
        return view('shop.feedback', compact('business'));
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
