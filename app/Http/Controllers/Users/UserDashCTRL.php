<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Owners\OwnerProduct;
use Illuminate\Http\Request;

class UserDashCTRL extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = OwnerProduct::whereNull('archived_at')->get();
        // Return the landing page view with products
        return view('users.dashboard', compact('products'));
    }
    
    public function show(string $id)
    {
        $products = OwnerProduct::whereNull('archived_at')->get();
        
        return view('users.products.productview', compact('products'));
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
