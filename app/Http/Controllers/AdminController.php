<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Http\Services\AdminService;
use DataTables;

class AdminController extends Controller
{
    private $service;

    public function __construct(AdminService $service)
    {   
        $this->service = $service;
    }

    public function index()
    {
        return view('owner/admin/index');
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {

    }

    public function destroy($id)
    {

    }

    public function getAdmins(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $routeEdit = route('owner.admins.edit', $row->id) ?? '';
                    $routeDelete = route('owner.admins.destroy', $row->id) ?? '';
                    $btn = '<a href="'.$routeEdit.'" class="edit btn btn-primary btn-sm">Ubah</a>
                    <button class="btn btn-danger btn-sm" data-id="'.$row->id.'" data-action="'.$routeDelete.'" onclick="deleteConfirmation('.$row->id.')">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }   
}
