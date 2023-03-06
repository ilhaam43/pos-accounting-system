<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SalesTransactionController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CashBalanceController;
use App\Http\Controllers\TransactionCategoryController;

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

        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::resource('/menus', MenuController::class);
        Route::resource('/sales-transactions', SalesTransactionController::class);
        
        Route::group(['as' => 'sales-transactions.', 'prefix' => 'sales-transactions'], function () {
            Route::post('/order', [SalesTransactionController::class, 'storeOrder'])->name('order.store');
            Route::delete('/order/{id}', [SalesTransactionController::class, 'destroyOrder'])->name('order.destroy');
        });
    });
});

// This is owner route access
Route::group(['middleware' => ['auth']], function () {
    Route::group(['as' => 'owner.', 'prefix' => 'owner', 'middleware' => ['checkLogin:owner']], function () {
        
        Route::get('/', [OwnerController::class, 'index'])->name('index');

        Route::group(['as' => 'report.', 'prefix' => 'report'], function () {
            Route::get('/sales-transactions', [ReportController::class, 'salesTransactionIndex'])->name('sales-transactions.index');
            Route::get('/income-statements', [ReportController::class, 'incomeStatementIndex'])->name('income-statements.index');
            Route::get('/cashflows', [ReportController::class, 'cashFlowIndex'])->name('cashflows.index');
        });
        
        Route::resource('/users', UserController::class);
        Route::resource('/incomes', IncomeController::class);
        Route::resource('/expenses', ExpenseController::class);
        Route::resource('/cash-balances', CashBalanceController::class);
        Route::resource('/transaction-categories', TransactionCategoryController::class);
    });
});


//This is export data route
Route::group(['as' => 'export.', 'prefix' => 'export'], function () {
    Route::group(['as' => 'pdf.', 'prefix' => 'pdf'], function () {
        Route::get('/receipt/{id}', [ExportController::class, 'generateReceipt'])->name('receipt');
        Route::get('/sales-transactions/{month}', [ExportController::class, 'generateSalesTransactionReport'])->name('sales-transactions');
        Route::get('/income-statements/{month}', [ExportController::class, 'generateIncomeStatement'])->name('income-statements');
        Route::get('/cashflows/{month}', [ExportController::class, 'generateCashflow'])->name('cashflows');
    });
});

//This is ajax data route
Route::group(['as' => 'ajax.', 'prefix' => 'ajax'], function () {
    Route::get('/menus', [MenuController::class, 'getMenus'])->name('menus');
    Route::get('/sales-transactions', [SalesTransactionController::class, 'getSalesTransactions'])->name('sales-transactions');
    Route::get('/users', [UserController::class, 'getUsers'])->name('users');
    Route::get('/transaction-categories', [TransactionCategoryController::class, 'getTransactionCategories'])->name('transaction-categories');
    Route::get('/incomes', [IncomeController::class, 'getIncomes'])->name('incomes');
    Route::get('/expenses', [ExpenseController::class, 'getExpenses'])->name('expenses');
    Route::get('/cash-balances', [CashBalanceController::class, 'getCashBalance'])->name('cash-balances');
    Route::get('/menus/{category}', [MenuController::class, 'getMenuByCategory'])->name('menus-category');
});

