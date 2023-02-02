<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\CashBalance;
use DataTables;

class CashBalanceController extends Controller
{
    public function index()
    {
        return view('owner/cash-balance/index');
    }

    public function store()
    {
        
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
