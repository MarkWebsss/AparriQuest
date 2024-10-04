<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Users\ShopController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\Admin\AdminRequestController;
use App\Http\Controllers\Owners\OwnerRequestController;
use App\Http\Controllers\Owners\CTRLimport;
use App\Http\Controllers\Admin\CTRLbusiness;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\DashCTRL;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route for the landing page
Route::get('/', function () {
    return view('welcome');
});




Route::get('/register/user', [RegisteredUserController::class, 'create'])->name('register.user');
Route::post('/register/user', [RegisteredUserController::class, 'store'])->name('register.user.submit');

// Route for business owner registration
Route::get('/register/business', [RegisteredUserController::class, 'createBusiness'])->name('register.business');
Route::post('/register/business', [RegisteredUserController::class, 'storeBusiness'])->name('register.business.submit');

Route::post('/owner/search-shop', [RegisteredUserController::class, 'searchShop'])->name('search.shop');
Route::post('/owner/register', [RegisteredUserController::class, 'storeBusiness'])->name('store');

// Redirects to specific dashboard based on the role of the user
Route::get('/dashboard', function () {
    $user = Auth::user();

    // Check if the user has any roles
    if ($user->roles->isEmpty()) {
        abort(403, 'Unauthorized');
    }

    // Check for specific roles
    foreach ($user->roles as $role) {
        if ($role->name == "admin") {
            return app(DashCTRL::class)->index();
        } elseif ($role->name == "owner") {
            return view('owner.dashboard');
        }
    }

    // Default to users dashboard if no admin or owner roles found
    return view('users.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes here
Route::prefix('admin')->middleware(['auth', 'can:admin-access'])->group(function () {

    Route::namespace('App\Http\Controllers\Admin')->group(function() {
        Route::resource('/users', 'UserController', ['except' => ['create', 'store', 'destroy']]);
        Route::get('/userfeedbacks', 'UserController@userfeedback')->name('userfeedback');
        Route::resource('/business', 'CTRLbusiness');
        Route::get('/shopsearch', 'CTRLbusiness@search')->name('business.search');
        Route::get('/log', 'CTRLadminLog@store')->name('store');
        Route::get('/userCount', 'CTRLbusiness@usercount')->name('userscount');
        
        Route::post('/import-data', [CTRLimport::class, 'import'])->name('data.import');
        // Route::resource('/dashboard', 'DashCTRL');
        Route::get('/dashboard', [DashCTRL::class, 'index'])->name('admin.dashboard');

    });
});


// Owner routes here
Route::prefix('owner')->middleware(['auth', 'can:owner-access'])->group(function () {
    Route::get('/dashboard', function () {
        return view('owner.dashboard');
    })->name('owner.dashboard');

    Route::get('/manage-requests', [OwnerRequestController::class, 'index'])->name('owner.manage-requests.index');
    // Add other owner-specific routes here
});

// Users routes here
Route::namespace('App\Http\Controllers\Users')->prefix('users')->name('users.')->middleware('can:user-access')->group(function () {
    Route::resource('/feedback', 'CTRLFeedbacks', ['except' => ['update', 'edit', 'destroy']]);
    Route::get('/myfeedbacks', 'CTRLFeedbacks@myfeedback')->name('myfeedback');
    Route::resource('/products', 'CTRLproducts');
    Route::get('/searchproducts', 'CTRLproducts@searchproducts')->name('searchproducts');
    Route::resource('/shopEdit', 'ShopController');
});

require __DIR__.'/auth.php';
