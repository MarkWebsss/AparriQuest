<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Admin\CTRLbusiness;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\VerifyNotification;
use App\Models\Admin\businesses;
use App\Models\Users\shop;

use DB;
class CTRLverify extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('users.business.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('users.business.update');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function search(Request $request)
    {
        $request->validate([
            'PermitNum' => 'required|exists:businesses,PermitNum'
        ]);
        
        $store = businesses::where('PermitNum', $request->PermitNum)->first();

        if ($store) {
            // If the business exists, return the view with success message
            return view('users.business.index', compact('store'))->with('success','You are a registered shop owner. Verify now.');
        } else {
            // If the business does not exist, return the view with error message
            return view('users.business.index')->with('error', 'Business not found.');
        }
        
    }

    
}

