<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CakeApiController;
use App\Http\Controllers\API\CartApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('all/products', [CakeApiController::class, 'index']);

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::group(['middleware' => 'cakeAdmin'], function() {


    // Cake routes
    Route::post('add/products', [CakeApiController::class, 'store']);
    Route::delete('/delete/product/{cake_id}', [CakeApiController::class, 'deleteProduct']);
    Route::post('edit/product/{cake_id}', [CakeApiController::class, 'editProduct']);
    });
    // Cart routes
    Route::get('/cart', [CartApiController::class, 'index']);
    Route::post('/cart/{cake_id}', [CartApiController::class, 'add']);
    Route::delete('/cart/{id}', [CartApiController::class, 'remove']);
    Route::post('/cart/order', [CartApiController::class, 'placeOrder']);
});