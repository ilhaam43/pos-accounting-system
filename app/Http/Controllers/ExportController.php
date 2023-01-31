<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
        $dates = explode('-', $date);
        $periode = date("F Y", strtotime($date));
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
}
