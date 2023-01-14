<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use App\Models\Transaction;
use App\Models\TransactionProduct;
use App\Models\TransactionOrder;

class TransactionService
{
    public function store($request)
    { 
        //logic to create transaction code by current date and how much data exist in current date
        $countTransaction = Transaction::whereDate('created_at', date('Y-m-d'))->count();
        $stringDate = strftime("%d%m%Y", time());

        //logic to check transaction count if 0 then transaction code will start from 0 and if more than zero it will start from latest count plus 1
        $paddedTransactionCount = str_pad($countTransaction + 1, 4, '0', STR_PAD_LEFT);
        $transactionCode = 'TRX-'.$stringDate.'-'.$paddedTransactionCount;

        //store transaction data
        $storeTransaction = new Transaction();
        $storeTransaction->transaction_code = $transactionCode;
        $storeTransaction->transaction_total_price = $request['transaction_total_price'];
        $storeTransaction->transaction_total_quantity = $request['transaction_total_quantity'];
        $storeTransaction->pay = $request['pay'];
        $storeTransaction->change = $request['change'];
        $storeTransaction->save();

        //create collection from transaction products data
        $zipped = Collection::make($request['product_name'])->zip($request['product_price'], $request['quantity_products'], $request['total_price']);
        $transactionProduct = $zipped->map(function ($values) {
            return (object) [
                'product_name' => $values[0],
                'price' => $values[1],
                'quantity' => $values[2],
                'total_price' => $values[3]
            ];
        });

        //get latest transaction to get transaction id
        $latestTransaction = Transaction::latest()->first();
        $transactionId = $latestTransaction->id;

        foreach($transactionProduct as $products){
            //store transaction product data
            $storeTransactionProduct = new TransactionProduct();
            $storeTransactionProduct->transaction_id = $transactionId;
            $storeTransactionProduct->product_name = $products->product_name;
            $storeTransactionProduct->price = $products->price;
            $storeTransactionProduct->quantity = $products->quantity;
            $storeTransactionProduct->total_price = $products->total_price;
            $storeTransactionProduct->save();
        }

        //delete transaction order data after store transaction & transaction product data
        $deleteTransactionOrder = TransactionOrder::truncate();

        return $storeTransactionProduct;
    }

    public function storeOrder($request)
    {
        //store product id to transaction order
        $storeTransactionOrder = new TransactionOrder();
        $storeTransactionOrder->product_id = $request['product_id'];
        $storeTransactionOrder->quantity = $request['quantity'];
        $storeTransactionOrder->save();

        return $storeTransactionOrder;
    }

    public function destroyOrder($id)
    {
        $transactionOrder = TransactionOrder::find($id);
        $transactionOrder->delete();
        return true;
    }
}