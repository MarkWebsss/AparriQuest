<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

use App\Models\Admin\adminLog;
use App\Models\Admin\businesses;
use App\Models\User;

class DashboardCTRL extends Controller
{
    public function index()
    {
        $storeCount = businesses::count();
        $totalAllUser = User::count();
        $totalUser = User::where('role_as', '0')->count();
        $totalAdmin = User::where('role_as', '1')->count();
        $totalOwner = User::where('role_as', '2')->count();


        return view('admin.dashboard', compact('storeCount','totalAllUser','totalUser','totalAdmin','totalOwner'));
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
        //
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
