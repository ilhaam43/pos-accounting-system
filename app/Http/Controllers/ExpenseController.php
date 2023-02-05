<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Expense;
use App\Models\TransactionCategory;
use App\Http\Services\ExpenseService;
use DataTables;

class ExpenseController extends Controller
{
    private $service;

    public function __construct(ExpenseService $service)
    {   
        $this->service = $service;
    }

    public function index()
    {   
        $transactionCategory = TransactionCategory::where('type', "Pengeluaran")->get();
        return view('owner/expense/index', compact('transactionCategory'));
    }

    public function store(Request $request)
    {
        try{    
            $store = $this->service->storeExpense($request);
        }catch(\Throwable $th){
            return redirect()->route('owner.expenses.index')->with('error', 'Tambah transaksi pengeluaran gagal dibuat.');
        }
        return redirect()->route('owner.expenses.index')->with('success', 'Tambah transaksi pengeluaran berhasil dibuat.');
    }

    public function destroy($id)
    {
        try{    
            $destroy = $this->service->destroyExpense($id);
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Data transaksi pengeluaran gagal dihapus.",]);
        }
        return response()->json(['success' => true, 'message' => "Data transaksi pengeluaran berhasil dihapus.",]);
    }

    public function getExpenses(Request $request)
    {
        if ($request->ajax()) {
            $data = Expense::with('TransactionCategory')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $routeDelete = route('owner.incomes.destroy', $row->id) ?? '';
                    $btn = '<button class="btn btn-danger btn-sm btn-rounded" data-id="'.$row->id.'" data-action="'.$routeDelete.'" onclick="deleteConfirmation('.$row->id.')">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }   
}
