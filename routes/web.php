<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

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

//this is login auth
Route::get('/', function () {
    return view('auth/login');
})->name('login');

Route::post('/', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/', [AuthController::class, 'index'])->name('login');

// This is admin route access
Route::group(['middleware' => ['auth']], function () {
    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['checkLogin:admin']], function () {
        
        Route::get('/', function () {
            return view('admin/index');
        })->name('index');
        
        Route::resource('/products', ProductController::class);
        
        Route::group(['as' => 'transactions.', 'prefix' => 'transactions'], function () {
            Route::resource('/', TransactionController::class);
            Route::post('/order', [TransactionController::class, 'storeOrder'])->name('order.store');
            Route::delete('/order/{id}', [TransactionController::class, 'destroyOrder'])->name('order.destroy');
        });
    });
});

//This is ajax data route
Route::group(['as' => 'ajax.', 'prefix' => 'ajax', 'middleware' => ['checkLogin:admin']], function () {
    Route::get('/products', [ProductController::class, 'getProducts'])->name('products');
});
