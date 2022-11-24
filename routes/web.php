<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['checkLogin:admin']], function () {
        Route::get('/admin', function () {
            return view('admin/index');
        });
    });
});
