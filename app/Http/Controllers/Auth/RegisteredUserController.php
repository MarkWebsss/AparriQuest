<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Admin\businesses;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the user registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming user registration request.
     *  @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // adds role to a newly registered user as user role 
        $role = Role::where('name', 'user')->first(); // Assuming "user" is a role
        if ($role) {
            $user->roles()->attach($role);
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the business owner registration view.
     */
    public function createBusiness(): View
    {
        return view('auth.ownerReg'); // returns the owner registration form
    }

    /**
     * Handle an incoming business owner registration request.
     */
    public function storeBusiness(Request $request): RedirectResponse
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|confirmed|min:8',
        'shop_id' => 'required|exists:businesses,id', // Ensure this is the correct field
    ]);

    // Create the user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Assign the 'owner' role
    $role = Role::where('name', 'owner')->first();
    if ($role) {
        $user->roles()->attach($role);
    } else {
        // Log an error or handle the missing role case
        \Log::error('Owner role not found.');
    }

    // Claim the shop
    $shop = businesses::find($request->shop_id);
    if ($shop) {
        $shop->ownerName = $user->name; // Set the owner name
        $shop->claimed_by = $user->id; // Update the claimed_by field
        $shop->save();
    } else {
        // Log an error or handle the case where the shop is not found
        \Log::error('Shop not found for claiming.');
    }

    Auth::login($user);
    return redirect(RouteServiceProvider::HOME); // Redirect to a specific route
}


    public function searchShop(Request $request)
    {
        $request->validate([
            'permit_number' => 'required|string',
        ]);

        // Find the shop by permit number
        $shop = businesses::where('PermitNum', $request->permit_number)->first();

        if ($shop) {
            return response()->json(['shop' => $shop]);
        } else {
            return response()->json(['error' => 'Shop not found'], 404);
        }
    }

    public function showRegistrationForm()
    {
        $roles = Role::all(); // Fetch all roles
        return view('auth.register', compact('roles'));
    }
}
