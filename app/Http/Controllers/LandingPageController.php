<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owners\OwnerProduct;

class LandingPageController extends Controller
{
    public function index()
    {
        // Retrieve all products from OwnerProduct model
        $products = OwnerProduct::all();

        // Return the landing page view with products
        return view('welcome', compact('products'));
    }
}
