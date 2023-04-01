<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'show']);
    Route::get('/{id}', [ProductController::class, 'showOneProduct']);
    Route::post('/', [ProductController::class, 'store']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
    Route::patch('/{id}', [ProductController::class, 'update']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'transactions'], function () {
    Route::get('/{id}', [TransactionController::class, 'showOneTransaction']);
    Route::get('/', [TransactionController::class, 'show']);
    Route::post('/', [TransactionController::class, 'store']);
    Route::post('/checkout/{id}', [TransactionController::class, 'checkout']);
    Route::post('/checkout/{id}', [TransactionController::class, 'checkout']);
    Route::post('/clearCart', [TransactionController::class, 'clearCart']);
    Route::post('/storeSession', [TransactionController::class, 'storeSession']);
    Route::delete('/deleteItem/{id}', [TransactionController::class, 'deleteItem']);
});
Route::group(['middleware' => 'auth', 'prefix' => 'customers'], function () {
    Route::get('/', [CustomerController::class, 'show']);
    Route::get('/{id}', [CustomerController::class, 'showOne']);
    Route::post('/', [CustomerController::class, 'store']);
    Route::delete('/{id}', [CustomerController::class, 'delete']);
    Route::patch('/{id}', [CustomerController::class, 'update']);
});
