<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\CashBalance;
use App\Http\Services\CashBalanceService;
use DataTables;

class CashBalanceController extends Controller
{
    private $service;

    public function __construct(CashBalanceService $service)
    {   
        $this->service = $service;
    }

    public function index()
    {
        $cashBalance = CashBalance::count();
        return view('owner/cash-balance/index', compact('cashBalance'));
    }

    public function edit($id)
    {
        $cashBalance = CashBalance::where('id', $id)->first();
        return view('owner/cash-balance/edit', compact('cashBalance'));
    }

    public function update($id, Request $request)
    {
        try{    
            $update = $this->service->updateCashBalance($request, $id);
        }catch(\Throwable $th){
            return $th;
            return redirect()->route('owner.cash-balances.edit')->with('error', 'Ubah saldo kas gagal.');
        }
        return redirect()->route('owner.cash-balances.index')->with('success', 'Ubah saldo kas berhasil.');
    }

    public function store(Request $request)
    {
        try{    
            $store = $this->service->storeCashBalance($request);
        }catch(\Throwable $th){
            return redirect()->route('owner.cash-balances.index')->with('error', 'Tambah saldo kas gagal dibuat.');
        }
        return redirect()->route('owner.cash-balances.index')->with('success', 'Tambah saldo kas berhasil dibuat.');
    }

    public function destroy($id)
    {
        try{    
            $destroy = $this->service->destroyCashBalance($id);
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Data saldo kas gagal dihapus.",]);
        }
        return response()->json(['success' => true, 'message' => "Data saldo kas berhasil dihapus.",]);
    }

    public function getCashBalance(Request $request)
    {
        if ($request->ajax()) {
            $data = CashBalance::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $routeEdit = route('owner.cash-balances.edit', $row->id) ?? '';
                    $routeDelete = route('owner.cash-balances.destroy', $row->id) ?? '';
                    $btn = '<a href="'.$routeEdit.'" class="edit btn btn-primary btn-sm">Ubah</a>
                    <button class="btn btn-danger btn-sm" data-id="'.$row->id.'" data-action="'.$routeDelete.'" onclick="deleteConfirmation('.$row->id.')">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
