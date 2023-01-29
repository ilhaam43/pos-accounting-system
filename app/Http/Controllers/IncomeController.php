<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Income;
use App\Models\TransactionCategory;
use App\Http\Services\IncomeService;
use DataTables;

class IncomeController extends Controller
{
    private $service;

    public function __construct(IncomeService $service)
    {   
        $this->service = $service;
    }

    public function index()
    {   
        $transactionCategory = TransactionCategory::where('type', "income")->get();
        return view('owner/income/index', compact('transactionCategory'));
    }

    public function store(Request $request)
    {
        try{    
            $store = $this->service->storeIncome($request);
        }catch(\Throwable $th){
            return $th;
            return redirect()->route('owner.incomes.index')->with('error', 'Tambah pemasukan gagal dibuat.');
        }
        return redirect()->route('owner.incomes.index')->with('success', 'Tambah pemasukan berhasil dibuat.');
    }

    public function destroy($id)
    {
        try{    
            $destroy = $this->service->destroyIncome($id);
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Data pemasukan gagal dihapus.",]);
        }
        return response()->json(['success' => true, 'message' => "Data pemasukan berhasil dihapus.",]);
    }

    public function getIncomes(Request $request)
    {
        if ($request->ajax()) {
            $data = Income::with('TransactionCategory')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $routeDelete = route('owner.incomes.destroy', $row->id) ?? '';
                    $btn = '<button class="btn btn-danger btn-sm" data-id="'.$row->id.'" data-action="'.$routeDelete.'" onclick="deleteConfirmation('.$row->id.')">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }   
}
