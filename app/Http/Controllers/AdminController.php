<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\SalesTransaction;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

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

        //chart count sales transaction by month 
        $countSalesTransactionByMonth = DB::table('sales_transactions')
        ->select(DB::raw('DATE_FORMAT(created_at, "%M") AS month_name'), DB::raw('COUNT(*) as count'))
        ->whereBetween('created_at', [now()->subMonths(11), now()])
        ->groupBy('month_name')
        ->orderBy(DB::raw('MONTH(created_at)'), 'desc')
        ->get();

        $months = collect([
            'January', 'February', 'March', 'April',
            'May', 'June', 'July', 'August',
            'September', 'October', 'November', 'December',
        ]);

        $countSalesTransactionByMonth = $months->map(function ($months) use ($countSalesTransactionByMonth) {
            $total = $countSalesTransactionByMonth->where('month_name', $months)->pluck('count')->first();
            return $total ?? 0;
        });

        for ($i = 0; $i < count($countSalesTransactionByMonth); $i++) {
            if (is_string($countSalesTransactionByMonth[$i])) {
                $countSalesTransactionByMonth[$i] = intval($countSalesTransactionByMonth[$i]);
            }
        }

        //chart sum income sales transaction by month 
        $countIncomeSalesTransactionByMonth = DB::table('sales_transactions')
        ->select(DB::raw('DATE_FORMAT(created_at, "%M") AS month_name'), DB::raw('SUM(transaction_total_price) AS total'))
        ->whereBetween('created_at', [now()->subMonths(11), now()])
        ->groupBy('month_name')
        ->orderBy(DB::raw('MONTH(created_at)'), 'desc')
        ->get();

        $countIncomeSalesTransactionByMonth = $months->map(function ($months) use ($countIncomeSalesTransactionByMonth) {
            $total = $countIncomeSalesTransactionByMonth->where('month_name', $months)->pluck('total')->first();
            return $total ?? 0;
        });

        for ($i = 0; $i < count($countIncomeSalesTransactionByMonth); $i++) {
            if (is_string($countIncomeSalesTransactionByMonth[$i])) {
                $countIncomeSalesTransactionByMonth[$i] = intval($countIncomeSalesTransactionByMonth[$i]);
            }
        }

        return view('admin/index', compact('menuCount', 'salesTransactionCount', 'salesTransactionToday', 'salesTransactionMonth', 'countSalesTransactionByMonth', 'countIncomeSalesTransactionByMonth'));
    }
}
