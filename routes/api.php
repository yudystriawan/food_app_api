<?php

use App\Http\Controllers\Api\Category\CategoryFoodController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Category\CategoryCustomerController;
use App\Http\Controllers\Api\Category\CategoryRestoController;
use App\Http\Controllers\Api\Category\CategoryTransactionController;
use App\Http\Controllers\Api\Customer\CustomerCategoryController;
use App\Http\Controllers\Api\Customer\CustomerTransactionController;
use App\Http\Controllers\Api\Customer\CustomerController;
use App\Http\Controllers\Api\Customer\CustomerFoodController;
use App\Http\Controllers\Api\Customer\CustomerRestoController;
use App\Http\Controllers\Api\Food\FoodCategoryController;
use App\Http\Controllers\Api\Food\FoodTransactionController;
use App\Http\Controllers\Api\Food\FoodController;
use App\Http\Controllers\Api\Food\FoodCustomerController;
use App\Http\Controllers\Api\Food\FoodCustomerTransactionController;
use App\Http\Controllers\Api\Resto\RestoCategoryController;
use App\Http\Controllers\Api\Resto\RestoTransactionController;
use App\Http\Controllers\Api\Resto\RestoController;
use App\Http\Controllers\Api\Resto\RestoCustomerController;
use App\Http\Controllers\Api\Resto\RestoFoodController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Transaction\TransactionCategoryController;
use App\Http\Controllers\Api\Transaction\TransactionController;
use App\Http\Controllers\Api\Transaction\TransactionRestoController;
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
Route::resource('restos.transactions', RestoTransactionController::class)->only(['index']);
Route::resource('restos.categories', RestoCategoryController::class)->only(['index']);
Route::resource('restos.customers', RestoCustomerController::class)->only(['index']);
Route::resource('restos.foods', RestoFoodController::class)->except(['create', 'show', 'edit']);

Route::resource('customers', CustomerController::class)->only(['index', 'show']);
Route::resource('customers.transactions', CustomerTransactionController::class)->only(['index']);
Route::resource('customers.foods', CustomerFoodController::class)->only(['index']);
Route::resource('customers.restos', CustomerRestoController::class)->only(['index']);
Route::resource('customers.categories', CustomerCategoryController::class)->only(['index']);

Route::resource('foods', FoodController::class)->only(['index', 'show']);
Route::resource('foods.transactions', FoodTransactionController::class)->only(['index']);
Route::resource('foods.customers', FoodCustomerController::class)->only(['index']);
Route::resource('foods.categories', FoodCategoryController::class)->except(['create', 'show', 'edit']);
Route::resource('foods.customers.transactions', FoodCustomerTransactionController::class)->only(['store']);

Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
Route::resource('transactions.categories', TransactionCategoryController::class)->only(['index']);
Route::resource('transactions.restos', TransactionRestoController::class)->only(['index']);

Route::resource('categories', CategoryController::class)->only(['index', 'show']);
Route::resource('categories.foods', CategoryFoodController::class)->only(['index']);
Route::resource('categories.restos', CategoryRestoController::class)->only(['index']);
Route::resource('categories.transactions', CategoryTransactionController::class)->only(['index']);
Route::resource('categories.customers', CategoryCustomerController::class)->only(['index']);

Route::resource('users', UserController::class)->except(['create'. 'edit']);
Route::get('users/verify/{token}', [UserController::class, 'verify'])->name('users.verify');
Route::get('users/{user}/resend', [UserController::class, 'resend'])->name('users.resend');