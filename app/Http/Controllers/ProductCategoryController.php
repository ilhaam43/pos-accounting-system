<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as DebugBar;
use App\Models\ProductCategory;
use App\Http\Requests\ProductCategoryRequest;
use App\Services\ProductCategoryService;

class ProductCategoryController extends Controller
{  
    private $productCategory;

    public function __construct(ProductCategoryService $productCategory)
    {
        $this->productCategory = $productCategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategory = ProductCategory::all();
        return view('admin.product-category.index', compact('productCategory'));
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
    public function store(ProductCategoryRequest $request)
    {
        try{    
            $store = $this->productCategory->store($request);
        }catch(\Throwable $th){
            return redirect()->route('admin.product-categories.index')->with('error', 'Product category failed to add');
        }
        return redirect()->route('admin.product-categories.index')->with('success', 'Product category added successfully');
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
        $productCategory = ProductCategory::findOrFail($id);
        return view('admin.product-category.edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $request, $id)
    {
        try{    
            $update = $this->productCategory->update($request, $id);
        }catch(\Throwable $th){
            return redirect()->route('admin.product-categories.index')->with('error', 'Product category failed to edit');
        }
        return redirect()->route('admin.product-categories.index')->with('success', 'Product category edit successfully');
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
            $store = $this->productCategory->destroy($id);
        }catch(\Throwable $th){
            return redirect()->route('admin.product-categories.index')->with('error', 'Product category failed to delete');
        }
        return redirect()->route('admin.product-categories.index')->with('success', 'Product category delete successfully');
    }
}
