<?php

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController as FrontProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;





// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', [HomeController::class, 'index'])->name('home'); //
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get("/products", [FrontProductsController::class, 'index'])->name('front.products.index');
Route::get("/products/grids", [FrontProductsController::class, 'showgrids'])->name('front.products.showgrids');
Route::get("/products/{product:slug}", [FrontProductsController::class, 'show'])->name('front.products.show');

require __DIR__ . '/dashboard.php';
require __DIR__ . '/auth.php';
