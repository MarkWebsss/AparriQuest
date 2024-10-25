<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\businesses;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $storeCount = businesses::count();
        $users = User::where('role_as','1')->get()->count();
        $admin = User::count('role_as','2');
        $owner = User::count('role_as','3');

        return view('admin.dashboard', compact('storeCount', 'users', 'admin', 'owner'));
    }
}
