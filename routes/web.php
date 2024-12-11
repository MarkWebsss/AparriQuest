<?php

use App\Http\Controllers\Admin\AdminProf;
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
use App\Http\Controllers\Owners\OwnerProf;
use App\Http\Controllers\Users\MapController;
use App\Models\Owners\OwnerProduct;
use App\Models\Admin\businesses;
use App\Http\Controllers\Users\CTRLproducts;
use App\Http\Controllers\Users\UserDashCTRL;
use App\Http\Controllers\Users\UserProf;

Route::get('/', [LandingPageController::class, 'index'])->name('landing.page');
Route::get('/search', [LandingPageController::class, 'search'])->name('search');
Route::get('/products/{id}', [LandingPageController::class, 'show'])->name('products.productview');
Route::get('/shop', [LandingPageController::class, 'shop'])->name('shop');

Route::post('/claim-shop', [CTRLOwners::class, 'claimShop'])->name('claim-shop');

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

Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->roles->isEmpty()) {
        abort(403, 'Unauthorized');
    }

    foreach ($user->roles as $role) {
        if ($role->name == "admin") {
            return app(DashCTRL::class)->index(); 
        } elseif ($role->name == "owner") {
            $userId = Auth::id();
            
            $business = businesses::where('user_id', $userId)
                ->where('status', 'Claimed') 
                ->first();

            $availableStockCount = OwnerProduct::where('user_id', $userId)
                ->where('status', 'Available')
                ->count();
            $outOfStockCount = OwnerProduct::where('user_id', $userId)
                ->where('status', 'Out of Stock')
                ->count();
            $productCount = OwnerProduct::where('user_id', $userId)->count();

            // Add a null check for $business
            if ($business) {
                $feedbacks = $business->feedback; // Fetch feedback if business exists
                $averageRating = $feedbacks->isNotEmpty() ? $feedbacks->avg('rating') : null;
                $viewCount = $business->view_count ?? 0;
            } else {
                $feedbacks = collect(); // Default to an empty collection if no business
                $averageRating = null;
                $viewCount = 0;
            }

            return view('owner.dashboard')->with(compact(
                'business', 'productCount', 'availableStockCount', 
                'outOfStockCount', 'viewCount', 'feedbacks', 'averageRating'
            ));
        }
    }

    $products = OwnerProduct::whereNull('archived_at')->get();
    $business = businesses::all();
    return view('users.dashboard')->with(compact('products', 'business'));
})->middleware(['auth', 'verified'])->name('dashboard');


// Profile routes
Route::middleware('auth')->group(function () {
    // Admin profile edit
    Route::get('/admin/profile', [AdminProf::class, 'edit'])->name('admin.edit');
    Route::patch('/admin/profile', [AdminProf::class, 'update'])->name('admin.update');

    // Owner profile edit
    Route::get('/owner/profile', [OwnerProf::class, 'edit'])->name('owner.edit');
    Route::patch('/owner/profile', [OwnerProf::class, 'update'])->name('owner.update');
    
    // User profile edit
    Route::get('/users/profile', [UserProf::class, 'edit'])->name('users.profile.edit');
    Route::patch('/users/profile', [UserProf::class, 'update'])->name('users.profile.update');
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
    Route::post('/claim-shop', [CTRLOwners::class, 'claimShop'])->name('owner.claim-shop');
    Route::get('/owner/shop-views-graph', [CTRLOwners::class, 'getShopViewsGraphData'])->name('owner.shop.views.graph');

    Route::resource('owner/products', ProductController::class);

    Route::get('/owner/business-profile', [OwnerProf::class, 'index'])->name('owner.business.profile');
    Route::put('/owner/business-profile/update-logo/{id}', [OwnerProf::class, 'updateLogo'])->name('owner.business.update-logo');

    Route::get('owner/feedback', [OwnerProf::class, 'feedback'])->name('owner.feedback');
    Route::get('owner/shop-feedback/{businessId}', [OwnerProf::class, 'shopfeedback'])->name('owner.shopfeedback');   

    Route::get('/owner/business-profile/{id}/edit/', [OwnerProf::class, 'shopedit'])->name('owner.business.edit');
    Route::put('/owner/business-profile/update/{id}', [OwnerProf::class, 'shopupdate'])->name('owner.business.update');

    // Routes to archive or unarchive a product
    Route::patch('products/{product}/archive', [ProductController::class, 'archive'])->name('products.archive');
    Route::patch('products/{product}/unarchive', [ProductController::class, 'unarchive'])->name('products.unarchive');

});

// User routes
Route::namespace('App\Http\Controllers\Users')->prefix('users')->name('users.')->middleware('can:user-access')->group(function () {
    Route::resource('/feedback', 'CTRLFeedbacks')->except(['update', 'edit', 'destroy']);
    Route::get('/myfeedbacks', 'CTRLFeedbacks@myfeedback')->name('myfeedback');
    Route::resource('/products', 'CTRLproducts');

    Route::get('/dashboard',  [UserDashCTRL::class, 'index'])->name('users.dashboard');

    Route::get('/view-shop/{id}', [ShopController::class, 'show'])->name('view.shop');

    Route::get('/products/{id}', 'CTRLproducts@show')->name('products.productview');
    Route::get('/search/product', 'CTRLproducts@searchproducts')->name('search.product');

    Route::get('/search/shop', 'CTRLproducts@search')->name('search.shop');

    Route::resource('/shop', 'ShopController');
    Route::get('/shop/{businessId}', [ShopController::class, 'shop'])->name('check.shop');

    Route::get('/map', 'MapController@index')->name('map.index');
    Route::get('/map/track/{id}', [MapController::class, 'trackProduct'])->name('map.track');

    Route::resource('/shop-feedback', 'ShopFeedbackCTRL');
});
