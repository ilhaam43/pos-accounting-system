<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Services\ProductService;
use DataTables;

class ProductController extends Controller
{
    private $service;

    public function __construct(ProductService $service)
    {   
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return view('admin/product/index');
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('admin/product/edit', compact('product'));
    }
    
    public function store(ProductRequest $request)
    {
        try{    
            $store = $this->service->storeProduct($request);
        }catch(\Throwable $th){
            return redirect()->route('admin.products.index')->with('error', 'Product data failed to create.');
        }
        return redirect()->route('admin.products.index')->with('success', 'Product data create successfully.');
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        try{    
            $update = $this->service->updateProduct($request, $id);
        }catch(\Throwable $th){
            return $th;
            return redirect()->route('admin.products.index')->with('error', 'Product data failed to update.');
        }
        return redirect()->route('admin.products.index')->with('success', 'Product data update successfully.');
    }

    public function destroy($id)
    {
        try{    
            $destroy = $this->service->destroyProduct($id);
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Product data failed to delete",]);
        }
        return response()->json(['success' => true, 'message' => "Product data deleted successfully",]);
    }

    public function getProducts(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row){
                    $asset = asset($row->image);
                    $image = '<img src="'.$asset.'" width="150" height="150"></img>';
                    return $image;
                })
                ->addColumn('action', function($row){
                    $routeEdit = route('admin.products.edit', $row->id) ?? '';
                    $routeDelete = route('admin.products.destroy', $row->id) ?? '';
                    $btn = '<a href="'.$routeEdit.'" class="edit btn btn-primary btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm" data-id="'.$row->id.'" data-action="'.$routeDelete.'" onclick="deleteConfirmation('.$row->id.')"> Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
    }
}
