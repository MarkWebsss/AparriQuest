<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\businesses; // Correct model path for businesses
use App\Models\User;
use App\Models\Role;

class DashCTRL extends Controller
{
    public function index()
    { // Count users by role
        $adminCount = Role::where('name', 'admin')->first()->users()->count();
        $usersCount = Role::where('name', 'user')->first()->users()->count();
        $ownerCount = Role::where('name', 'owner')->first()->users()->count();

        $userCount = User::count(); // Get the total user count
        $shopCount = businesses::count(); // Get the total shop count
    
        return view('admin.dashboard', compact('userCount', 'shopCount', 'adminCount', 'usersCount', 'ownerCount')); 
    }
}

