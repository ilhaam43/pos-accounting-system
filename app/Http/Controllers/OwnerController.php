<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Income;
use App\Models\Expense;
use App\Models\SalesTransaction;
use App\Models\CashBalance;

class OwnerController extends Controller
{
    public function index()
    {
        $today = now();
        $date = date("Y-m-d", strtotime($today));
        $periode = date("Y-m", strtotime($today));
        $periode = explode('-', $periode);

        $salesTransactionMonth = SalesTransaction::whereMonth('created_at', $periode[1])->whereYear('created_at', $periode[0])->get();
        $salesTransactionMonth = $salesTransactionMonth->sum('transaction_total_price');

        $user = User::count();

        $income = Income::whereMonth('created_at', $periode[1])->whereYear('created_at', $periode[0])->get();
        $income = $income->sum('value') + $salesTransactionMonth;

        $expense = Expense::whereMonth('created_at', $periode[1])->whereYear('created_at', $periode[0])->get();
        $expense = $expense->sum('value');

        $cashBalance = CashBalance::latest()->first();
        return view('owner/index', compact('user', 'income', 'expense', 'cashBalance'));
    }
}
