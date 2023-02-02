<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReportController extends Controller
{
    public function salesTransactionIndex()
    {
        return view('owner/report/sales-transaction/index');
    }

    public function incomeStatementIndex()
    {
        return view('owner/report/income-statement/index');
    }

    public function cashflowIndex()
    {
        return view('owner/report/cashflow/index');
    }
}
