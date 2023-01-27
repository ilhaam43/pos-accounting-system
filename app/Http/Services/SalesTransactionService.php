<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use App\Models\SalesTransaction;
use App\Models\SalesTransactionDetail;
use App\Models\SalesTransactionOrder;

class SalesTransactionService
{
    public function store($request)
    { 
        //logic to create sales transaction code by current date and how much data exist in current date
        $countTransaction = SalesTransaction::whereDate('created_at', date('Y-m-d'))->count();
        $stringDate = strftime("%d%m%Y", time());

        //logic to check sales transaction count if 0 then transaction code will start from 0 and if more than zero it will start from latest count plus 1
        $paddedTransactionCount = str_pad($countTransaction + 1, 4, '0', STR_PAD_LEFT);
        $transactionCode = 'TRX-'.$stringDate.'-'.$paddedTransactionCount;

        //store sales transaction data
        $storeSalesTransaction = new SalesTransaction();
        $storeSalesTransaction->transaction_code = $transactionCode;
        $storeSalesTransaction->transaction_total_price = $request['transaction_total_price'];
        $storeSalesTransaction->transaction_total_quantity = $request['transaction_total_quantity'];
        $storeSalesTransaction->pay = $request['pay'];
        $storeSalesTransaction->change = $request['change'];
        $storeSalesTransaction->save();

        //create collection from sales transaction detail data
        $zipped = Collection::make($request['menu_name'])->zip($request['menu_price'], $request['quantity_menus'], $request['total_price']);
        $salesTransactionDetail = $zipped->map(function ($values) {
            return (object) [
                'menu_name' => $values[0],
                'price' => $values[1],
                'quantity' => $values[2],
                'total_price' => $values[3]
            ];
        });

        //get latest sales transaction to get sales transaction id
        $latestSalesTransaction = SalesTransaction::latest()->first();
        $salesTransactionId = $latestSalesTransaction->id;

        foreach($salesTransactionDetail as $menus){
            //store sales transaction details data
            $storeSalesTransactionDetail = new SalesTransactionDetail();
            $storeSalesTransactionDetail->transaction_id = $salesTransactionId;
            $storeSalesTransactionDetail->menu_name = $menus->menu_name;
            $storeSalesTransactionDetail->price = $menus->price;
            $storeSalesTransactionDetail->quantity = $menus->quantity;
            $storeSalesTransactionDetail->total_price = $menus->total_price;
            $storeSalesTransactionDetail->save();
        }

        //delete sales transaction order data after store sales transaction & sales transaction detail data
        $deleteSalesTransactionOrder = SalesTransactionOrder::truncate();

        return $storeSalesTransactionDetail;
    }

    public function storeOrder($request)
    {
        //store menu id to sales transaction order
        $storeSalesTransactionOrder = new SalesTransactionOrder();
        $storeSalesTransactionOrder->menu_id = $request['menu_id'];
        $storeSalesTransactionOrder->quantity = $request['quantity'];
        $storeSalesTransactionOrder->save();

        return $storeSalesTransactionOrder;
    }

    public function destroyOrder($id)
    {
        $salesTransactionOrder = SalesTransactionOrder::find($id);
        $salesTransactionOrder->delete();
        return true;
    }
}