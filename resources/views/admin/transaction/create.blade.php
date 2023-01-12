@extends('admin.layout.template')
@section('content')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Create Transactions</h4>
                            <span class="ml-1"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Create Transactions</a></li>
                        </ol>
                    </div>
                    </div>
                <!-- row -->
                @if (session('error'))
                    <div class="alert alert-danger solid alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                        <strong>Error!</strong> 
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success solid alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                        <strong>Success!</strong> 
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                            
                            </div>

                            <div class="card-body">
                            <div class="basic-form">
                                    <form method="POST" action="{{ route('admin.transactions.order.store') }}">
                                    @csrf
                                    <div class="input-group">
                                    <select type="text" class="form-control" name="product_id">
                                    <option selected>Choose...</option>
                                        @foreach($product as $products) 
                                            <option value="{{$products->id}}">{{$products->name}}</option>
                                        @endforeach
                                    </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">Add Order</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                </br>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Product Image</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transactionOrder as $orders)
                                            <tr>
                                                <th>{{ ++$i }}</th>
                                                <td><img src="{{asset($orders->products->image)}}" width="120" height="120"></td>
                                                <td>{{ $orders->products->name }}</td>
                                                <td>1</td>
                                                <td>{{ $orders->products->price }}</td>
                                                <td>
                                                <form onsubmit="return confirm('Apakah anda yakin ingin menghapus produk ini ?');" action="{{ route('admin.transactions.order.destroy', $orders->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        @endsection
        @push('custom-scripts')
            <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
            
        @endpush