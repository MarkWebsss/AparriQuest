<?php

namespace App\Http\Controllers\Owners;

use App\Http\Controllers\Controller;
use App\Models\Owners\OwnerProduct; // Make sure the namespace is correct
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Import the Storage facade

class ProductController extends Controller
{
    public function index()
    {
        // Fetch products for the logged-in user
        $products = OwnerProduct::where('user_id', Auth::id())->get();
        return view('owner.products.index', compact('products'));
    }

    public function create()
    {
        return view('owner.products.create'); // Assuming you have this view
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|string' // Make sure status is required
    ]);

    $imagePath = null; // Initialize imagePath
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    OwnerProduct::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'user_id' => Auth::id(),
        'image' => $imagePath,
        'status' => $request->status // Ensure status is included here
    ]);

    return redirect()->route('products.index')->with('success', 'Product added successfully!');
}


    public function edit($id)
    {
        // Find the product by ID for editing
        $product = OwnerProduct::findOrFail($id);
        return view('owner.products.edit', compact('product')); // Use edit.blade.php
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|string' // Make sure status is required
    ]);

    $product = OwnerProduct::findOrFail($id);
    
    // Check if there's a new image to upload
    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;
    }

    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'status' => $request->status, // Ensure status is included here
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}


    public function destroy($id)
    {
        // Find the product by ID
        $product = OwnerProduct::findOrFail($id);
        
        // Ensure the product belongs to the authenticated user before deleting
        if ($product->user_id === Auth::id()) {
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
        }

        return redirect()->route('products.index')->with('error', 'Unauthorized action.');
    }
}