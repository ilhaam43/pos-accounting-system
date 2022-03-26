@section('title', 'Product Category')
@extends('admin.dashboard.layouts.app')
@section('content')

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product Categories</h4>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addProductCategoryModal">Add Category</button></br></br>
                        <div class="table-responsive">
                        <table class="table cell-border" id="example">
                            <thead>
                            <tr>
                                <th width="5%"> No. </th>
                                <th> Category </th>
                                <th width="20%"> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($productCategory as $row)
                            <tr>
                                <td> {{ $loop->index + 1 }} </td>
                                <td> {{ $row->category_name }} </td>
                                <td>
                                <a href="{{route('admin.product-categories.edit', $row->id)}}" class="btn btn-primary fa fa-pencil-alt" title="edit">
                                Edit
                            </a>
                            <form action="{{ route('admin.product-categories.destroy', $row->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?');" title="delete">
                                    <i class="fa fa-trash">Delete</i>
                                </button>
                            </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
</div>
@include('admin.product-category.create')
@endsection