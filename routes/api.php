<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\RestoController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('restos', RestoController::class)->only(['index', 'show']);

Route::resource('customers', CustomerController::class)->only(['index', 'show']);

Route::resource('foods', FoodController::class)->only(['index', 'show']);

Route::resource('transactions', TransactionController::class)->only(['index', 'show']);

Route::resource('categories', CategoryController::class);

Route::resource('users', UserController::class)->except(['create'. 'edit']);