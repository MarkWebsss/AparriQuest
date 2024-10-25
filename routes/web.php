<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Users\ShopController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\Admin\AdminRequestController;
use App\Http\Controllers\Owners\CTRLimport;
use App\Http\Controllers\Admin\CTRLbusiness;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\DashCTRL;
use App\Http\Controllers\Owners\CTRLOwners;
use App\Http\Controllers\Owners\ProductController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Users\MapController;



Route::get('/', [LandingPageController::class, 'index'])->name('landing.page');
Route::get('/search', [LandingPageController::class, 'search'])->name('search');

Route::post('/claim-shop', [CTRLowners::class, 'claimShop'])->name('claim-shop');

// Authentication routes
require __DIR__ . '/auth.php';

// User registration routes
Route::get('/register/user', [RegisteredUserController::class, 'create'])->name('register.user');
Route::post('/register/user', [RegisteredUserController::class, 'store'])->name('register.user.submit');

// Business owner registration routes
Route::get('/register/business', [RegisteredUserController::class, 'createBusiness'])->name('register.business');
Route::post('/register/business', [RegisteredUserController::class, 'storeBusiness'])->name('register.business.submit');

// Route to search for shops
Route::post('/owner/search-shop', [RegisteredUserController::class, 'searchShop'])->name('search.shop');
Route::post('/owner/register', [RegisteredUserController::class, 'storeBusiness'])->name('store');

// Redirects to specific dashboard based on the role of the user
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // Check if the user has any roles
    if ($user->roles->isEmpty()) {
        abort(403, 'Unauthorized');
    }

    // Redirect based on user role
    foreach ($user->roles as $role) {
        if ($role->name == "admin") {
            return app(DashCTRL::class)->index(); // Admin dashboard logic
        } elseif ($role->name == "owner") {
            // Fetch the business data for the owner
            $userId = Auth::id();
            $business = \App\Models\Admin\businesses::where('user_id', $userId)
                ->where('status', 'Claimed')
                ->first();

            // Pass $business to the owner dashboard view
            return view('owner.dashboard')->with('business', $business);
        }
    }

    // Default to users dashboard if no admin or owner roles found
    return view('users.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'can:admin-access'])->group(function () {
    Route::namespace('App\Http\Controllers\Admin')->group(function () {
        Route::resource('/users', 'UserController')->except(['create', 'store', 'destroy']);
        Route::get('/userfeedbacks', 'UserController@userfeedback')->name('userfeedback');
        Route::resource('/business', 'CTRLbusiness');
        Route::post('/shopsearch', 'CTRLbusiness@search')->name('business.search');
        Route::get('/userCount', 'CTRLbusiness@usercount')->name('userscount');
        Route::post('/import-data', [CTRLimport::class, 'import'])->name('data.import');
        Route::get('/dashboard', [DashCTRL::class, 'index'])->name('admin.dashboard');
    });
});

// Owner routes
Route::prefix('owner')->middleware(['auth', 'can:owner-access'])->group(function () {

    Route::get('/register', [RegisteredUserController::class, 'createBusiness'])->name('owner.register');
    Route::post('/register', [RegisteredUserController::class, 'storeBusiness'])->name('register.business.submit'); 

    Route::get('/dashboard', [CTRLOwners::class, 'index'])->name('owner.dashboard');
    Route::post('/claim-shop', [CTRLOwners::class, 'claimShop'])->name('claim-shop');
    
    Route::resource('owner/products', ProductController::class);
});

// User routes
Route::namespace('App\Http\Controllers\Users')->prefix('users')->name('users.')->middleware('can:user-access')->group(function () {
    Route::resource('/feedback', 'CTRLFeedbacks')->except(['update', 'edit', 'destroy']);
    Route::get('/myfeedbacks', 'CTRLFeedbacks@myfeedback')->name('myfeedback');
    Route::resource('/products', 'CTRLproducts');

    Route::get('/products/{id}', 'CTRLproducts@show')->name('products.productview');
    Route::get('/searchproducts', 'CTRLproducts@searchproducts')->name('searchproducts');
    Route::resource('/shopEdit', 'ShopController');

    Route::get('/map', 'MapController@index')->name('map.index');
    Route::get('/map/track/{id}', [MapController::class, 'trackProduct'])->name('map.track');
});
