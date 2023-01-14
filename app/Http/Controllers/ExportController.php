<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Transaction;
use App\Models\TransactionProduct;
use Mpdf\Mpdf;

class ExportController extends Controller
{
    public function generateReceipt($transactionId)
    {
        $transaction = Transaction::where('id', $transactionId)->with('transactionProducts')->first();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML(view('pdf/receipt', compact('transaction'))->render());
        $mpdf->Output('receipt.pdf', 'I');
    }
}
