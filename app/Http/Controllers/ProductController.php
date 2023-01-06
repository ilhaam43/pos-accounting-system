<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;

class ProductController extends Controller
{
    private $service;

    public function __construct(ProductService $service)
    {   
        $this->service = $service;
    }

    public function index()
    {
        $product = Product::all();
        return view('admin/product/index', compact('product'))->with('i');
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

    public function destroy($id)
    {
        try{    
            $destroy = $this->service->destroyProduct($id);
        }catch(\Throwable $th){
            return redirect()->route('admin.products.index')->with('error', 'Product data failed to delete.');
        }
        return redirect()->route('admin.products.index')->with('success', 'Product data success to delete.');
    }
}
