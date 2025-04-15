<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\productsController as ApiproductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('product', [ApiproductsController::class, 'index'])->name('api.product.index');
Route::get('product/{product}', [ApiproductsController::class, 'show'])->name('api.product.show');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('product', [ApiproductsController::class, 'store'])->name('api.product.store');
    Route::put('product/{product}', [ApiproductsController::class, 'update'])->name('api.product.update');
    Route::delete('product/{product}', [ApiproductsController::class, 'destroy'])->name('api.product.destroy');
    Route::delete('auth/access-tokens/{token?}', [AccessTokensController::class, 'destroy'])->name('auth.tokens.destroy');
});
Route::post('auth/access-tokens', [AccessTokensController::class, 'store'])->name('auth.tokens.store')->middleware('guest:sanctum');
