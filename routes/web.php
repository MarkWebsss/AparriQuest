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
use App\Http\Controllers\Owners\OwnerDashCTRL;
use App\Http\Controllers\Admin\AdminDashCTRL;
use App\Http\Controllers\Users\UserProf;
use App\Http\Controllers\Admin\AdminClaimRequestController;
use App\Http\Controllers\Users\ShopFeedbackCTRL;

Route::get('/', [LandingPageController::class, 'index'])->name('landing.page');
Route::get('/search', [LandingPageController::class, 'search'])->name('search');
Route::get('/products/{id}', [LandingPageController::class, 'show'])->name('products.productview');
Route::get('/shop', [LandingPageController::class, 'shop'])->name('shop');

Route::post('/notifications/mark-all-read', [CTRLOwners::class, 'markAllAsRead']);

Route::post('/claim-shop', [CTRLOwners::class, 'claimShop'])->name('claim-shop');

Route::get('/business/{id}', [LandingPageController::class, 'business'])->name('business.show');

Route::get('/api/businesses', function () {
    return businesses::select('id', 'businessName', 'fullAddress', 'businessEmail', 'businessPhone', 'latitude', 'longitude')->get();
});
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
    foreach ($user->roles as $role) {
        if ($role->name == "admin") {
            return redirect()->route('admin.dashboard'); 
        }
        if ($role->name == "owner") {
            return redirect()->route('owner.dashboard'); 
        }
    }
    return redirect()->route('users.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', [DashCTRL::class, 'index'])->name('admin.dashboard');

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

        Route::get('/claim-requests', [AdminClaimRequestController::class, 'index'])->name('admin.claim-requests.index');
        Route::get('/claim-request/{claimRequest}', [AdminClaimRequestController::class, 'show'])->name('admin.claim-requests.show');
        Route::put('/claim-request/{claimRequest}/approve', [AdminClaimRequestController::class, 'approve'])->name('admin.claim-requests.approve');
        Route::put('/claim-request/{claimRequest}/reject', [AdminClaimRequestController::class, 'reject'])->name('admin.claim-requests.reject');

        Route::get('/report', 'ReportController@generateReport')->name('admin.report');
        Route::get('/admin/report/export', 'ReportController@export')->name('admin.report.export');
    });
});

Route::prefix('owner')->middleware(['auth', 'can:owner-access'])->group(function () {
    // Dashboard route (no need for extra middleware)
    Route::get('/dashboard', [OwnerDashCTRL::class, 'index'])->name('owner.dashboard');

    // Claim shop related routes
    Route::get('/claim-shop', [CTRLOwners::class, 'showClaimForm'])->name('owner.claim-form');
    Route::post('/claim-shop', [CTRLOwners::class, 'submitClaimRequest'])->name('owner.submit.claim');
    Route::post('/owner/claim-shop', [CTRLOwners::class, 'claimShop'])->name('owner.claim-shop');

    // Business registration
    Route::get('/register', [RegisteredUserController::class, 'createBusiness'])->name('owner.register');
    Route::post('/register', [RegisteredUserController::class, 'storeBusiness'])->name('register.business.submit');

    // Shop views graph
    Route::get('/owner/shop-views-graph', [CTRLOwners::class, 'getShopViewsGraphData'])->name('owner.shop.views.graph');

    // Product routes
    Route::resource('owner/products', ProductController::class);
    Route::patch('products/{product}/archive', [ProductController::class, 'archive'])->name('products.archive');
    Route::patch('products/{product}/unarchive', [ProductController::class, 'unarchive'])->name('products.unarchive');

    // Business Profile Routes
    Route::get('/owner/business-profile', [OwnerProf::class, 'index'])->name('owner.business.profile');
    Route::put('/owner/business-profile/update-logo/{id}', [OwnerProf::class, 'updateLogo'])->name('owner.business.update-logo');
    Route::get('/owner/business-profile/{id}/edit/', [OwnerProf::class, 'shopedit'])->name('owner.business.edit');
    Route::put('/owner/business-profile/update/{id}', [OwnerProf::class, 'shopupdate'])->name('owner.business.update');

    // Feedback Routes
    Route::get('owner/feedback', [OwnerProf::class, 'feedback'])->name('owner.feedback');
    Route::get('owner/shop-feedback/{businessId}', [OwnerProf::class, 'shopfeedback'])->name('owner.shopfeedback');
}); 

// User routes
Route::namespace('App\Http\Controllers\Users')->prefix('users')->name('users.')->middleware('can:user-access')->group(function () {
    Route::get('/dashboard', [UserDashCTRL::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
    Route::resource('/feedback', 'CTRLFeedbacks')->except(['update', 'edit', 'destroy']);
    Route::get('/myfeedbacks', 'CTRLFeedbacks@myfeedback')->name('myfeedback');
    Route::resource('/products', 'CTRLproducts');

    Route::get('/view-shop/{id}', [ShopController::class, 'show'])->name('view.shop');

    Route::get('/products/{id}', 'CTRLproducts@show')->name('products.productview');
    Route::get('/search/product', 'CTRLproducts@searchproducts')->name('search.product');
    Route::get('/search/shop', 'CTRLproducts@search')->name('search.shop');
    Route::get('/search/all', 'CTRLproducts@allsearch')->name('search');

    Route::resource('/shop', 'ShopController');
    Route::get('/shop/{businessId}', [ShopController::class, 'shop'])->name('check.shop');

    Route::get('/map', 'MapController@index')->name('map.index');
    Route::get('/map/track/{id}', [MapController::class, 'trackProduct'])->name('map.track');

    Route::resource('/shop-feedback', 'ShopFeedbackCTRL');
    Route::get('/shop-feedback/{id}', [ShopFeedbackCTRL::class, 'feedback'])->name('shopfeedback');
});
