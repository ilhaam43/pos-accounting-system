<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Income;
use App\Models\Expense;
use App\Models\SalesTransaction;
use App\Models\SalesTransactionDetail;
use Mpdf\Mpdf;

class ExportController extends Controller
{
    public function generateReceipt($transactionId)
    {
        $salesTransaction = SalesTransaction::where('id', $transactionId)->with('salesTransactionDetail')->first();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML(view('pdf/receipt', compact('salesTransaction'))->render());
        $mpdf->Output('receipt.pdf', 'I');
    }

    public function generateSalesTransactionReport($date)
    {
        $english_months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $indonesian_months = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $dates = explode('-', $date);
        $periode = date("F Y", strtotime($date));
        $periode = str_replace($english_months, $indonesian_months, $periode);

        $salesTransaction = SalesTransactionDetail::selectRaw('menu_name, sum(total_price) as total_prices, sum(quantity) as quantitys')
        ->whereMonth('created_at', $dates[1])
        ->whereYear('created_at', $dates[0])
        ->groupBy('menu_name')
        ->get();
        $sumTotalPrices = $salesTransaction->sum('total_prices');
        $sumTotalQuantity = $salesTransaction->sum('quantitys');
        
        $mpdf = new Mpdf();
        $mpdf->WriteHTML(view('pdf/sales-transactions', compact('salesTransaction', 'periode', 'sumTotalPrices', 'sumTotalQuantity'))->render());
        $mpdf->Output('sales-transactions.pdf', 'I');
    }

    public function generateIncomeStatement($date)
    {
        $english_months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $indonesian_months = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $dates = explode('-', $date);
        $periode = date("F Y", strtotime($date));
        $periode = str_replace($english_months, $indonesian_months, $periode);

        $salesTransaction = SalesTransaction::whereMonth('created_at', $dates[1])->whereYear('created_at', $dates[0])->get();
        $incomes = Income::whereMonth('created_at', $dates[1])->whereYear('created_at', $dates[0])->with('transactionCategory')->get();
        $expenses = Expense::whereMonth('created_at', $dates[1])->whereYear('created_at', $dates[0])->with('transactionCategory')->get();
        $sumTotalPrices = $salesTransaction->sum('transaction_total_price');
        $sumIncomes = $incomes->sum('value');
        $sumExpenses = $expenses->sum('value');

        $mpdf = new Mpdf();
        $mpdf->WriteHTML(view('pdf/income-statement', compact('salesTransaction', 'periode', 'sumTotalPrices', 'incomes', 'expenses', 'sumIncomes', 'sumExpenses'))->render());
        $mpdf->Output('pdf.income-statement', 'I');
    }
}
