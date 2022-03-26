@section('title', 'Edit Product Category')
@extends('admin.dashboard.layouts.app')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Product Categories</h4>
                        <form action="{{route('admin.product-categories.update', $productCategory->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <input type="text" class="form-control" name="category_name" placeholder="Category Name" value="{{ $productCategory->category_name }}" required>
                        </div>
                        <div class="form-row">
                        <div class="col-sm-3">
                            <a href="{{route('admin.product-categories.index')}}" class="btn btn-danger btn-block btn-md">Cancel</a>
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