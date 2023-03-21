<?php

use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::group(['middleware' => ['auth']], function ($route) {
    $route->get('/', [DashboardController::class, 'index'])->name('dashboard');
});

// API data
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('getOrdersByUser', [OrderController::class, 'getOrdersByUser']);
        Route::get('getOrderDetails/{order}', [OrderController::class, 'getOrderDetails']);
        Route::get('export/{order}', [OrderController::class, 'exportOrder']);
    });
});

require __DIR__.'/auth.php';
