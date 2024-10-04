<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\businesses;

class ShopController extends Controller
{
    public function index()
    {
        
        return view('users.shops.index');
    }

    public function update(Request $request)
    {
        $shop = businesses::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // Add other validation rules as needed
        ]);
    
        // Update the shop
        $shop->update($validatedData);
    
        return redirect()->route('users.shops.index', $shop->id)
                         ->with('success', 'Shop updated successfully');
    }
}
