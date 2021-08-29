<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Artisan::call('storage:link');

Route::get('checkout/{product}',[CheckoutController::class, 'checkout']);
Route::post('checkout',[CheckoutController::class, 'store'])->name('checkout.store');

