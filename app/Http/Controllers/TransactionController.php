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
use DataTables;

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
        $totalPrice = 0;
        $totalQuantity = 0;
        
        //loop for sum total price from transaction order
        foreach($transactionOrder as $orders){
            $quantity = $orders->quantity;
            $price = $orders->products->price;
            $subtotal = $quantity * $price;
            $totalQuantity += $quantity;
            $totalPrice += $subtotal;
        }

        return view('admin/transaction/create', compact('product', 'transactionOrder', 'totalPrice', 'totalQuantity'))->with('i');
    }

    public function store(Request $request)
    {   
        try{    
            $store = $this->service->store($request);
        }catch(\Throwable $th){
            return $th;
            return redirect()->route('admin.transactions.index')->with('error', 'Transaction failed to create.');
        }
        return redirect()->route('admin.transactions.index')->with('success', 'Transaction create successfully.');
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
            return redirect()->route('admin.transactions.create')->with('error', 'Order data failed to delete.');
        }
        return redirect()->route('admin.transactions.create')->with('success', 'Order data delete successfully.');
    }

    public function getTransactions(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $routeBill = route('admin.transactions.edit', $row->id) ?? '';
                    $btn = '<a href="'.$routeBill.'" class="edit btn btn-danger btn-rounded">Invoice</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
