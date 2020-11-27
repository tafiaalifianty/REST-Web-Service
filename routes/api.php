<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'v1'], function ($router) {
    Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
        Route::get('/me', [AuthController::class, 'me'])->name('me');
    });

    Route::group(['middleware' => 'auth:api', 'prefix' => 'users'], function ($router) {
        Route::get('/{id}', [UserController::class, 'show']);
    });

    Route::group(['middleware' => 'auth:api', 'prefix' => 'pembelian'], function ($router) {
        Route::get('/{id}', [OrderController::class, 'show']);
        Route::post('/{user_id}', [OrderController::class, 'store']);
    });
    
    Route::post('/pembayaran/{order_id}', [PaymentController::class, 'store'])->middleware('auth:api');
});
