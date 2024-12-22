<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Role;
use App\Models\Admin\businesses;
use App\Models\Owners\ClaimRequest;
use App\Models\ShopRegistration;
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
        // Just return the view for registration
        return view('auth.ownerReg'); // Correct this to the view that shows the form
    }

    public function storeBusiness(Request $request): RedirectResponse
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255', 
            'lastName' => 'required|string|max:255',
            'ownerHouseNo' => 'required|string|max:255',
            'ownerStreetAddress' => 'required|string|max:255',
            'ownerCity' => 'required|string|max:255',
            'ownerEmail' => 'required|email|max:255',
            'ownerPhone' => 'required|string|max:15',
            'tin_number' => 'required|digits_between:1,20',
            'businessName' => 'required|string|max:255',
            'businessNo' => 'required|string|max:255',
            'BusStreetAddress' => 'required|string|max:255',
            'businessCity' => 'required|string|max:255',
            'businessEmail' => 'required|email|max:255',
            'businessPhone' => 'required|string|max:15',
        ]);
        $fullName = $request->firstName . ' ' . ($request->middleName ? $request->middleName . ' ' : '') . $request->lastName;
        // Create the user (owner)
        $fullAddress = $request->businessNo . ' ' . ($request->BusStreetAddress ? $request->BusStreetAddress . ' ' : '') . $request->businessCity;
        try {
            $user = User::create([
                'name' => $fullName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Log::info('User created', ['user_id' => $user->id]);
        } catch (\Exception $e) {
            Log::error('User creation failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['registration' => 'Failed to register user.']);
        }
    
        // Create the business record
        try {
            $business = businesses::create([
                'user_id' => $user->id,
                'firstName' => $request->firstName,
                'middleName' => $request->middleName,
                'lastName' => $request->lastName,
                'ownerHouseNo' =>  $request->ownerHouseNo,
                'ownerStreetAddress' =>  $request->ownerStreetAddress,
                'ownerCity' =>  $request->ownerCity,
                'ownerEmail' => $request->ownerEmail,
                'ownerPhone' => $request->ownerPhone,
                'tin_number' => $request->tin_number,
                'businessName' => $request->businessName,
                'businessEmail' => $request->businessEmail,
                'businessPhone' => $request->businessPhone,
                'businessNo' => $request->businessNo,
                'BusStreetAddress' => $request->BusStreetAddress,
                'businessCity' => $request->businessCity,
                'status' => 'pending', 
                'fullName' => $fullName,
                'fullAddress' => $fullAddress,
            ]);
            Log::info('Business created', ['business_id' => $business->id]);
        } catch (\Exception $e) {
            Log::error('Business creation failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['registration' => 'Failed to save business details.']);
        }
    
        // Assign the 'owner' role
        $role = Role::where('name', 'owner')->first();
        if ($role) {
            $user->roles()->attach($role);
            Log::info('Role assigned', ['role_id' => $role->id]);
        } else {
            Log::error('Owner role not found.');
        }
    
        // Log the user in
        Auth::login($user);
    
        return redirect()->route('owner.dashboard');
    }
    

    public function showRegistrationForm()
    {
        $roles = Role::all(); // Fetch all roles
        return view('auth.register', compact('roles'));
    }
}
