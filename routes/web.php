<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CakeController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChocolateController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

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

//Route::get('/', action: function () {
  //  return view('welcome');
//});
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/chocolate', [App\Http\Controllers\ChocolateController::class, 'index'])->name('chocolate');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::get('/testimonial', [App\Http\Controllers\TestimonialController::class, 'index'])->name('testimonial');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contacts');

Route::post('/add_cart/{id}', [CartController::class, 'add_cart'])->name('add_cart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/remove_cart/{id}', [CartController::class, 'remove_cart'])->name('remove_cart');
Route::get('/cash_order', [CartController::class, 'cash_order'])->name('cash.order');
Route::get('/my_order', [CartController::class, 'my_order'])->name('my_order');
Route::get('/delivered/{id}', [CartController::class, 'delivered'])->name('delivered');
Route::get('/cancel_order/{id}', [CartController::class, 'cancel_order'])->name('cancel_order');

Route::get('/cake/export', [CakeController::class, 'export'])->name('cake.export');
Route::get('/cakes/pdf', [CakeController::class, 'exportPdf'])->name('cakes.pdf');

Route::group(['middleware'=>'cakeAdmin'], function(){


Route::get('/cake/create', [App\Http\Controllers\CakeController::class, 'create'])->name('cake.create');
Route::get('/cake/index/cake', [App\Http\Controllers\CakeController::class, 'index'])->name('cake.index');
Route::post('/cake/store', [App\Http\Controllers\CakeController::class, 'store'])->name('cake.store');

Route::put('/cake/{id}/update', [App\Http\Controllers\CakeController::class, 'update'])->name('cake.update');

Route::get('/cake/{id}/edit', [App\Http\Controllers\CakeController::class, 'edit'])->name('cake.edit');
Route::delete('/cake/{cake}', [App\Http\Controllers\CakeController::class, 'destroy'])->name('cake.delete');

Route::get('/cake/order', [App\Http\Controllers\CakeController::class, 'order'])->name('cake.order');                                         

});   
require __DIR__.'/auth.php';

Route::post('/logout-on-tab-close', function () {
    Auth::logout();
    Session::invalidate();
    Session::regenerateToken();
    return response()->noContent(); // 204 No Content
})->middleware('auth'); 
