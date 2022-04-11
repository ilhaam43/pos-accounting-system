@section('title', 'Product')
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
                        <h4 class="card-title">Product</h4>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addProductCategoryModal">Add Product</button></br></br>
                        <div class="table-responsive">
                        <table class="table cell-border" id="example">
                            <thead>
                            <tr>
                                <th width="5%"> No. </th>
                                <th width="10%"> Product Code </th>
                                <th width="10%"> Product Category </th>
                                <th width="10%"> Product Name </th>
                                <th width="10%"> Buy Price </th>
                                <th width="10%"> Sell Price </th>
                                <th width="10%"> Discount </th>
                                <th width="10%"> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $row)
                            <tr>
                                <td> {{ $loop->index + 1 }} </td>
                                <td> {{ $row->product_code }} </td>
                                <td> {{ $row->productCategory->category_name }} </td>
                                <td> {{ $row->product_name }} </td>
                                <td> {{ $row->buy_price }} </td>
                                <td> {{ $row->sell_price }} </td>
                                <td> {{ $row->discount }} </td>
                                <td>
                                <a href="{{route('admin.products.edit', $row->id)}}" class="btn btn-primary fa fa-pencil-alt" title="edit">
                                Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $row->id) }}" method="post" class="d-inline">
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
@include('admin.products.create')
@endsection