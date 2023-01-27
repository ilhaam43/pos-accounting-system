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
}
