<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'web'], function ($router) {
    Route::get('/me', [WebController::class, 'me'])->name('me');
    Route::get('/member', [WebController::class, 'member'])->name('member');
    Route::get('/order', [WebController::class, 'order'])->name('order');
    Route::get('/orderget', [WebController::class, 'orderget'])->name('orderget');
    Route::get('/payment', [WebController::class, 'payment'])->name('payment');
    Route::get('/tiketid', [WebController::class, 'tiketid'])->name('tiketid');
    Route::get('/tiketuser', [WebController::class, 'tiketuser'])->name('tiketuser');
    Route::get('/log', [WebController::class, 'log'])->name('log');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['middleware' => 'auth:api', 'prefix' => 'users'], function ($router) {

// });
