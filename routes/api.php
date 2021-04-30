<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/products',[ProductController::class,'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{name}',[ProductController::class,'search']);
//Route::resource('products',ProductController::class);

//Private Routes
Route::post('/products',[ProductController::class,'store']);
Route::group(['middleware'=>['auth:sanctum']],function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
