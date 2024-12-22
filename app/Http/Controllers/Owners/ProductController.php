<?php

namespace App\Http\Controllers\Owners;

use App\Http\Controllers\Controller;
use App\Models\Owners\OwnerProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        $showArchived = $request->input('show_archived', false);
        
        $business = auth()->user()->business; // Get the user's business
    
        $products = OwnerProduct::where('user_id', Auth::id())
            ->when(!$showArchived, function ($query) {
                return $query->notArchived();  
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);  
            })
            ->when($showArchived, function ($query) {
                return $query->whereNotNull('archived_at');  
            })
            ->orderBy('created_at', 'desc')
            ->get();
    
        $productCount = $products->count(); 
        
        return view('owner.products.index', compact('products', 'productCount', 'business')); // Pass $business to the view
    }
    
    public function create()
    {
        $business = auth()->user()->business; // Get the user's business
        
        if ($business && $business->status === 'pending') {
            // Redirect the user to the business claim page or show a warning message
            return redirect()->route('owner.submit.claim')->with('error', 'Your shop is still pending approval. You cannot add products until it is claimed.');
        }
    
        return view('owner.products.create', compact('business')); // Pass $business to the view
    }
    

    public function store(Request $request)
    {
        if (Auth::user()->business == null) {
            return redirect()->route('owner.dashboard')->with('error', 'You must claim a shop before adding products.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string' 
        ]);

        $imagePath = null; 
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        OwnerProduct::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => Auth::id(),
            'image' => $imagePath,
            'status' => $request->status,
            'category' => $request->category
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = OwnerProduct::findOrFail($id);
        return view('owner.products.edit', compact('product')); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string'
        ]);

        $product = OwnerProduct::findOrFail($id);
        
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
            'category' => $request->category,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = OwnerProduct::findOrFail($id);
    
        if ($product->user_id === Auth::id()) {
            $product->update([
                'archived_at' => now(), 
            ]);
    
            return redirect()->route('products.index')->with('success', 'Product archived successfully!');
        }
    
        return redirect()->route('products.index')->with('error', 'Unauthorized action.');
    }

    public function archive($id)
    {
        $product = OwnerProduct::findOrFail($id);
        
        if ($product->user_id === Auth::id()) {
            $product->update([
                'archived_at' => now(), 
            ]);

            return redirect()->route('products.index')->with('success', 'Product archived successfully!');
        }
        
        return redirect()->route('products.index')->with('error', 'Unauthorized action.');
    }

    public function unarchive($id)
    {
        $product = OwnerProduct::findOrFail($id);
        
        if ($product->user_id === Auth::id()) {
            $product->update([
                'archived_at' => null,
            ]);

            return redirect()->route('products.index')->with('success', 'Product unarchived successfully!');
        }
        
        return redirect()->route('products.index')->with('error', 'Unauthorized action.');
    }

}
