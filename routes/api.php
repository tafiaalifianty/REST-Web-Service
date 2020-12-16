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
        Route::post('/register', [AuthController::class, 'register'])->name('api.register');
        Route::post('/login', [AuthController::class, 'login'])->name('api.login');
        Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
        Route::post('/refresh', [AuthController::class, 'refresh'])->name('api.refresh');
        Route::get('/me', [AuthController::class, 'me'])->name('api.me');
    });

    Route::group(['middleware' => 'auth:api', 'prefix' => 'users'], function ($router) {
        Route::get('/{id}', [UserController::class, 'show'])->name('api.user');
        Route::patch('/update/{id}', [UserController::class, 'update'])->name('api.update');
    });

    Route::group(['middleware' => 'auth:api', 'prefix' => 'ticket'], function ($router) {
        Route::get('/{id}', [TicketController::class, 'show']);
        Route::get('/user/{user_id}', [TicketController::class, 'user']);
    });

    Route::group(['middleware' => 'auth:api', 'prefix' => 'pembelian'], function ($router) {
        Route::get('/{id}', [OrderController::class, 'show']);
        Route::post('/{user_id}', [OrderController::class, 'store']);
    });

    Route::post('/pembayaran/{order_id}', [PaymentController::class, 'store'])->middleware('auth:api');
    Route::delete('/delete/{id}', [UserController::class, 'delete']);

});

Route::get('/tes', function () {
    return "Oke";
});
