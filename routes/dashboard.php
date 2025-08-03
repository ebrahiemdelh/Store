<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController as DashProfileController;
use App\Http\Middleware\CheckUserType;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => [
        'auth:admin',
        // "auth.type:admin,super-admin",
    ],
    'as' => 'dashboard.',  //used to make the name used in route dashboard.category.create for example
    'prefix' => 'admin/dashboard',
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home'); // 'verified' if for email verification
    Route::get('/dashboard', function() {
        return view('dashboard'); // This is the dashboard view
    })->name('dash'); // 'verified' if for email verification

    Route::get('/profile/edit', [DashProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [DashProfileController::class, 'update'])->name('profile.update');

    // ==================================================
    Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');
    //===================================================
    Route::get('/products/trash', [ProductController::class, 'trash'])->name('products.trash');
    Route::put('/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{product}/force-delete', [ProductController::class, 'forceDelete'])->name('products.force-delete');
    // Resource Controllers
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
});
