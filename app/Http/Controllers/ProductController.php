<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as DebugBar;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{  
    private $product;

    public function __construct(ProductService $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('ProductCategory')->get();
        $productCategory = ProductCategory::all();
        
        return view('admin.products.index', compact('products', 'productCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try{    
            $store = $this->product->store($request);
        }catch(\Throwable $th){
            return redirect()->route('admin.products.index')->with('error', 'Product failed to add');
        }
        return redirect()->route('admin.products.index')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $productCategory = ProductCategory::all();
        return view('admin.products.edit', compact('product', 'productCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try{    
            $update = $this->product->update($request, $id);
        }catch(\Throwable $th){
            return redirect()->route('admin.products.index')->with('error', 'Product failed to edit');
        }
        return redirect()->route('admin.products.index')->with('success', 'Product edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{    
            $store = $this->product->destroy($id);
        }catch(\Throwable $th){
            return redirect()->route('admin.products.index')->with('error', 'Product failed to delete');
        }
        return redirect()->route('admin.products.index')->with('success', 'Product delete successfully');
    }
}
