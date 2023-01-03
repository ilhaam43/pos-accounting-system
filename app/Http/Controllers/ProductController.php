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
        return view('admin/product/index');
    }

    public function store(ProductRequest $request)
    {
        try{    
            $store = $this->service->storeProduct($request);
        }catch(\Throwable $th){
            return redirect()->route('admin.products.index')->with('error', 'Product data failed to create');
        }
        return redirect()->route('admin.products.index')->with('success', 'Product data create successfully');
    }
}
