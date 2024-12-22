<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Owners\OwnerProduct;
use App\Models\Admin\businesses;

class UserDashCTRL extends Controller
{
    public function index()
    {

        // Default user dashboard (for normal users)
        $products = OwnerProduct::whereNull('archived_at')->paginate(10);
        $business = businesses::all();
        
        return view('users.dashboard')->with(compact('products', 'business'));
    }
}
