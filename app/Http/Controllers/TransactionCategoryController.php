<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\TransactionCategory;
use App\Http\Services\TransactionCategoryService;
use DataTables;

class TransactionCategoryController extends Controller
{
    private $service;

    public function __construct(TransactionCategoryService $service)
    {   
        $this->service = $service;
    }

    public function index()
    {   
        return view('owner/transaction-category/index');
    }

    public function store(Request $request)
    {
        try{    
            $store = $this->service->storeTransactionCategory($request);
        }catch(\Throwable $th){
            return $th;
            return redirect()->route('owner.transaction-categories.index')->with('error', 'Tambah kategori transaksi gagal dibuat.');
        }
        return redirect()->route('owner.transaction-categories.index')->with('success', 'Tambah kategori transaksi berhasil dibuat.');
    }

    public function destroy($id)
    {
        try{    
            $destroy = $this->service->destroyTransactionCategory($id);
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Data kategori transaksi gagal dihapus.",]);
        }
        return response()->json(['success' => true, 'message' => "Data kategori transaksi berhasil dihapus.",]);
    }

    public function getTransactionCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = TransactionCategory::groupBy('type')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $routeEdit = route('owner.transaction-categories.edit', $row->id) ?? '';
                    $routeDelete = route('owner.transaction-categories.destroy', $row->id) ?? '';
                    $btn = '<button class="btn btn-danger btn-sm" data-id="'.$row->id.'" data-action="'.$routeDelete.'" onclick="deleteConfirmation('.$row->id.')">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }   
}
