<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Http\Services\UserService;
use DataTables;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {   
        $this->service = $service;
    }

    public function index()
    {   
        return view('owner/user/index');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('owner/user/edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        try{    
            $update = $this->service->updateUser($request, $id);
        }catch(\Throwable $th){
            return $th;
            return redirect()->route('owner.users.edit')->with('error', 'Ubah pengguna gagal.');
        }
        return redirect()->route('owner.users.index')->with('success', 'Ubah pengguna berhasil.');
    }

    public function store(Request $request)
    {
        try{    
            $store = $this->service->storeUser($request);
        }catch(\Throwable $th){
            return redirect()->route('owner.users.index')->with('error', 'Tambah pengguna gagal dibuat.');
        }
        return redirect()->route('owner.users.index')->with('success', 'Tambah pengguna berhasil dibuat.');
    }

    public function destroy($id)
    {
        try{    
            $destroy = $this->service->destroyUser($id);
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Data pengguna gagal dihapus.",]);
        }
        return response()->json(['success' => true, 'message' => "Data pengguna berhasil dihapus.",]);
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $routeEdit = route('owner.users.edit', $row->id) ?? '';
                    $routeDelete = route('owner.users.destroy', $row->id) ?? '';
                    $btn = '<a href="'.$routeEdit.'" class="edit btn btn-primary btn-sm btn-rounded">Ubah</a>
                    <button class="btn btn-danger btn-sm btn-rounded" data-id="'.$row->id.'" data-action="'.$routeDelete.'" onclick="deleteConfirmation('.$row->id.')">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }   
}
