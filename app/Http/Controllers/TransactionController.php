<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Http\Services\TransactionService;
use App\Models\Transaction;
use App\Models\TransactionProduct;
use App\Models\TransactionOrder;

class TransactionController extends Controller
{
    private $service;

    public function __construct(TransactionService $service)
    {   
        $this->service = $service;
    }

    public function index()
    {
        return view('admin/transaction/index');
    }

    public function create()
    {
        $product = Product::all();
        $transactionOrder = TransactionOrder::with('Products')->get();
        return view('admin/transaction/create', compact('product', 'transactionOrder'))->with('i');
    }

    public function storeOrder(Request $request)
    {
        try{    
            $store = $this->service->storeOrder($request);
        }catch(\Throwable $th){
            return redirect()->route('admin.transactions.create')->with('error', 'Order data failed to create.');
        }
        return redirect()->route('admin.transactions.create')->with('success', 'Order data create successfully.');
    }

    public function destroyOrder($id)
    {
        try{    
            $destroy = $this->service->destroyOrder($id);
        }catch(\Throwable $th){
            return $th;
            return redirect()->route('admin.transactions.create')->with('error', 'Order data failed to delete.');
        }
        return redirect()->route('admin.transactions.create')->with('success', 'Order data delete successfully.');
    }
}
