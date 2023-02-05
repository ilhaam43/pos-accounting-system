<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\SalesTransaction;
use App\Models\Menu;

class AdminController extends Controller
{
    public function index()
    {
        $today = now();
        $date = date("Y-m-d", strtotime($today));
        $periode = date("Y-m", strtotime($today));
        $periode = explode('-', $periode);
        
        $menuCount = Menu::count();
        $salesTransactionCount = SalesTransaction::whereMonth('created_at', $periode[1])->whereYear('created_at', $periode[0])->count();

        $salesTransactionToday = SalesTransaction::where('created_at', '>=', $date)->get();
        $salesTransactionToday = $salesTransactionToday->sum('transaction_total_price');

        $salesTransactionMonth = SalesTransaction::whereMonth('created_at', $periode[1])->whereYear('created_at', $periode[0])->get();
        $salesTransactionMonth = $salesTransactionMonth->sum('transaction_total_price');

        return view('admin/index', compact('menuCount', 'salesTransactionCount', 'salesTransactionToday', 'salesTransactionMonth'));
    }
}
