@section('title', 'Edit Product')
@extends('admin.dashboard.layouts.app')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Product</h4>
                        <form action="{{route('admin.products.update', $product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                        <label for="product_category"><b>Product Category</label></b>
                        <select class="form-control" name="product_category_id">
                            @foreach($productCategory as $categories)
                            <option value="{{$categories->id}}">{{$categories->category_name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group">
                                <label for="product_code">Product Code</label>
                                <input type="text" class="form-control" name="product_code" placeholder="Product Code" value="{{ $product->product_code }}" required>
                        </div>
                        <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" name="product_name" placeholder="Product Name" value="{{ $product->product_name }}" required>
                        </div>
                        <div class="form-group">
                                <label for="product_name">Buy Price</label>
                                <input type="text" class="form-control" name="buy_price" placeholder="Buy Price" value="{{ $product->buy_price }}" required>
                        </div>
                        <div class="form-group">
                                <label for="product_name">Sell Price</label>
                                <input type="text" class="form-control" name="sell_price" placeholder="Sell Price" value="{{ $product->sell_price }}" required>
                        </div>
                        <div class="form-group">
                                <label for="product_name">Discount</label>
                                <input type="text" class="form-control" name="discount" placeholder="Discount" value="{{ $product->discount }}" required>
                        </div>
                        <div class="form-row">
                        <div class="col-sm-3">
                            <a href="{{route('admin.products.index')}}" class="btn btn-danger btn-block btn-md">Cancel</a>
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary btn-block btn-md">Save</button>
                        </div>
                        </div>
                        </form>
                    </div>
                    </div>
</div>
@endsection