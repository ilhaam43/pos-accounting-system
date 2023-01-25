<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Menu;
use App\Http\Requests\MenuRequest;
use App\Http\Requests\MenuUpdateRequest;
use App\Http\Services\MenuService;
use DataTables;

class MenuController extends Controller
{
    private $service;

    public function __construct(MenuService $service)
    {   
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return view('admin/menu/index');
    }

    public function edit($id)
    {
        $menu = Menu::where('id', $id)->first();
        return view('admin/menu/edit', compact('menu'));
    }
    
    public function store(MenuRequest $request)
    {
        try{    
            $store = $this->service->storeMenu($request);
        }catch(\Throwable $th){
            return $th;
            return redirect()->route('admin.menus.index')->with('error', 'Data menu gagal dibuat.');
        }
        return redirect()->route('admin.menus.index')->with('success', 'Data menu berhasil dibuat.');
    }

    public function update(MenuUpdateRequest $request, $id)
    {
        try{    
            $update = $this->service->updateMenu($request, $id);
        }catch(\Throwable $th){
            return $th;
            return redirect()->route('admin.menus.index')->with('error', 'Data menu gagal diubah.');
        }
        return redirect()->route('admin.menus.index')->with('success', 'Data menu berhasil diubah.');
    }

    public function destroy($id)
    {
        try{    
            $destroy = $this->service->destroyMenu($id);
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Data menu gagal dihapus.",]);
        }
        return response()->json(['success' => true, 'message' => "Data menu berhasil dihapus.",]);
    }

    public function getMenus(Request $request)
    {
       // Rp. {{ number_format($transaction->transaction_total_price, 2, ",", ".") }}
        if ($request->ajax()) {
            $data = Menu::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('price', function($row){
                    $price = 'Rp.'.number_format($row->price, 2, ",", ".");
                    return $price;
                })
                ->addColumn('image', function($row){
                    $asset = asset($row->image);
                    $image = '<img src="'.$asset.'" width="150" height="150"></img>';
                    return $image;
                })
                ->addColumn('action', function($row){
                    $routeEdit = route('admin.menus.edit', $row->id) ?? '';
                    $routeDelete = route('admin.menus.destroy', $row->id) ?? '';
                    $btn = '<a href="'.$routeEdit.'" class="edit btn btn-primary btn-sm">Ubah</a>
                    <button class="btn btn-danger btn-sm" data-id="'.$row->id.'" data-action="'.$routeDelete.'" onclick="deleteConfirmation('.$row->id.')">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
    }
}
