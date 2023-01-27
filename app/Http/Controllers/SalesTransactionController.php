<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Menu;
use App\Http\Services\SalesTransactionService;
use App\Models\SalesTransaction;
use App\Models\SalesTransactionDetail;
use App\Models\SalesTransactionOrder;
use DataTables;

class SalesTransactionController extends Controller
{
    private $service;

    public function __construct(SalesTransactionService $service)
    {   
        $this->service = $service;
    }

    public function index()
    {
        return view('admin/sales-transaction/index');
    }

    public function create()
    {
        $menu = Menu::all();
        $salesTransactionOrder = SalesTransactionOrder::with('Menu')->get();
        $totalPrice = 0;
        $totalQuantity = 0;
        
        //loop for sum total price from sales transaction order
        foreach($salesTransactionOrder as $orders){
            $quantity = $orders->quantity;
            $price = $orders->menu->price;
            $subtotal = $quantity * $price;
            $totalQuantity += $quantity;
            $totalPrice += $subtotal;
        }

        return view('admin/sales-transaction/create', compact('menu', 'salesTransactionOrder', 'totalPrice', 'totalQuantity'))->with('i');
    }

    public function store(Request $request)
    {   
        try{    
            $store = $this->service->store($request);
        }catch(\Throwable $th){
            return $th;
            return redirect()->route('admin.sales-transactions.index')->with('error', 'Transaksi penjualan gagal dibuat.');
        }
        return redirect()->route('admin.sales-transactions.index')->with('success', 'Transaksi penjualan berhasil dibuat.');
    }

    public function storeOrder(Request $request)
    {
        try{    
            $store = $this->service->storeOrder($request);
        }catch(\Throwable $th){
            return redirect()->route('admin.sales-transactions.create')->with('error', 'Data pemesanan gagal dibuat.');
        }
        return redirect()->route('admin.sales-transactions.create')->with('success', 'Data pemesanan berhasil dibuat.');
    }

    public function destroyOrder($id)
    {
        try{    
            $destroy = $this->service->destroyOrder($id);
        }catch(\Throwable $th){
            return redirect()->route('admin.sales-transactions.create')->with('error', 'Data pemesanan gagal dihapus.');
        }
        return redirect()->route('admin.sales-transactions.create')->with('success', 'Data pemesanan berhasil dihapus.');
    }

    public function getSalesTransactions(Request $request)
    {
        if ($request->ajax()) {
            $data = SalesTransaction::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('transaction_total_price', function($row){
                    $totalPrice = 'Rp.'.number_format($row->transaction_total_price, 2, ",", ".");
                    return $totalPrice;
                })
                ->addColumn('pay', function($row){
                    $pay = 'Rp.'.number_format($row->pay, 2, ",", ".");
                    return $pay;
                })
                ->addColumn('change', function($row){
                    $change = 'Rp.'.number_format($row->change, 2, ",", ".");
                    return $change;
                })
                ->addColumn('action', function($row){
                    $routeReceipt = route('export.pdf.receipt', $row->id) ?? '';
                    $btn = '<a href="'.$routeReceipt.'" class="edit btn btn-danger btn-rounded">Struk</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
