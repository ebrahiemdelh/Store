<?php

use App\Http\Controllers\Front\Auth\TwoFactorAuthenticationController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController as FrontProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Route;





// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', [HomeController::class, 'index'])->name('home'); //
Route::get('/dashboard', function () {
    return view('dashboard'); // This is the dashboard view
})->name('dash'); // 'verified' if for email verification
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get("/products", [FrontProductsController::class, 'index'])->name('front.products.index');
Route::get("/products/grids", [FrontProductsController::class, 'showgrids'])->name('front.products.showgrids');
Route::get("/products/{product:slug}", [FrontProductsController::class, 'show'])->name('front.products.show');


Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::resource("/cart", CartController::class)->only(['index', 'store', 'update', 'destroy']);



Route::get("/about-us", function () {
    return view("aboutUs");
})->name("about_us");
Route::get("/contact", function () {
    return view("contact");
})->name('contact');
Route::get("/faq", function () {
    return view("FAQ");
})->name("FAQ");
// Route::get("/login", function () {
//     return view("auth.login");
// })->name('front.login');
// Route::get("/register", function () {
//     return view("auth.register");
// })->name('front.register');
Route::post('currency', [\App\Http\Controllers\Front\CurrencyConverterController::class, 'store'])->name('currency.store');
Route::get('/auth/user/2fa', [TwoFactorAuthenticationController::class, 'index'])->name('2fa.index');

require __DIR__ . '/dashboard.php';
// require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
