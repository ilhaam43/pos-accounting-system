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

    public function edit($id)
    {
        $admin = User::where('id', $id)->first();
        return view('owner/admin/edit', compact('admin'));
    }

    public function update($id, Request $request)
    {
        try{    
            $update = $this->service->updateAdmin($request, $id);
        }catch(\Throwable $th){
            return $th;
            return redirect()->route('owner.admins.edit')->with('error', 'Ubah admin gagal.');
        }
        return redirect()->route('owner.admins.index')->with('success', 'Ubah admin berhasil.');
    }

    public function store(Request $request)
    {
        try{    
            $store = $this->service->storeAdmin($request);
        }catch(\Throwable $th){
            return redirect()->route('owner.admins.index')->with('error', 'Tambah admin gagal dibuat.');
        }
        return redirect()->route('owner.admins.index')->with('success', 'Tambah admin berhasil dibuat.');
    }

    public function destroy($id)
    {
        try{    
            $destroy = $this->service->destroyAdmin($id);
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Data admin gagal dihapus.",]);
        }
        return response()->json(['success' => true, 'message' => "Data admin berhasil dihapus.",]);
    }

    public function getAdmins(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('role', 'admin')->get();
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
