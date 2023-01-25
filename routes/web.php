<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ExportController;

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
        
        Route::resource('/menus', MenuController::class);
        
        Route::group(['as' => 'transactions.', 'prefix' => 'transactions'], function () {
            Route::resource('/', TransactionController::class);
            Route::post('/order', [TransactionController::class, 'storeOrder'])->name('order.store');
            Route::delete('/order/{id}', [TransactionController::class, 'destroyOrder'])->name('order.destroy');
        });
    });
});

//This is export data route
Route::group(['as' => 'export.', 'prefix' => 'export', 'middleware' => ['checkLogin:admin']], function () {
    Route::group(['as' => 'pdf.', 'prefix' => 'pdf'], function () {
        Route::get('/receipt/{id}', [ExportController::class, 'generateReceipt'])->name('receipt');
    });
});

//This is ajax data route
Route::group(['as' => 'ajax.', 'prefix' => 'ajax', 'middleware' => ['checkLogin:admin']], function () {
    Route::get('/menuss', [MenuController::class, 'getMenus'])->name('menus');
    Route::get('/transactions', [TransactionController::class, 'getTransactions'])->name('transactions');
});

