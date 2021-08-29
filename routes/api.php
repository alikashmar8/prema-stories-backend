<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group([
    'prefix' => 'categories'
], function ($router) {
    Route::get('/', [CategoriesController::class, 'index']);
    Route::get('/{category}', [CategoriesController::class, 'show']);
    Route::post('/', [CategoriesController::class, 'store']);
    Route::put('/{category}', [CategoriesController::class, 'update']);
    Route::delete('/{category}', [CategoriesController::class, 'delete']);
});

Route::group([
    'prefix' => 'products'
], function ($router) {
    Route::get('/', [ProductsController::class, 'index']);
    Route::get('/{product}', [ProductsController::class, 'show']);
    Route::get('/count/{number}', [ProductsController::class, 'getByNumber']);
    Route::post('/', [ProductsController::class, 'store']);
    Route::post('/{product}', [ProductsController::class, 'update']);
    Route::delete('/{product}', [ProductsController::class, 'delete']);
});


Route::group([
    'prefix' => 'orders'
], function ($router) {
    Route::get('/', [OrdersController::class, 'index']);
    Route::get('/{order}', [OrdersController::class, 'show']);
    Route::post('/', [OrdersController::class, 'store']);
    Route::post('/{order}', [OrdersController::class, 'update']);
    Route::post('/{order}/updateStatus', [OrdersController::class, 'updateStatus']);
    Route::delete('/{order}', [OrdersController::class, 'delete']);
});


Route::group([
    'prefix' => 'users'
], function ($router) {
    Route::post('/sendEmail', [UsersController::class, 'sendContactUsEmail']);
});
