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
                                <form class="form-inline" method="POST" action="{{ route('admin.transactions.order.store') }}">
                                @csrf
                                        <div class="form-group mb-2">
                                            <label class="sr-only">Product</label>
                                            <select type="text" class="form-control" name="product_id" required>
                                            <option selected>Choose Product...</option>
                                                @foreach($product as $products) 
                                                    <option value="{{$products->id}}">{{$products->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label class="sr-only">Quantity</label>
                                            <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-rounded mb-2">Add Item</button>
                                </form>
                            </div>
                            </br>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th width="5%">No.</th>
                                                <th scope="col">Product Image</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Subtotal Price</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @csrf
                                            @foreach($transactionOrder as $orders)
                                            <tr>
                                                <th>{{ ++$i }}</th>
                                                <td><img src="{{asset($orders->products->image)}}" width="120" height="120"></td>
                                                <td><h6>{{ $orders->products->name }}</h6></td>
                                                <td><h6>{{ $orders->quantity }}</h6></td>
                                                <td><h6>Rp. {{ number_format($orders->products->price, 2, ",", ".") ?? 0 }}</h6></td>
                                                <td><h6>Rp. {{ number_format($orders->products->price * $orders->quantity, 2, ",", ".") ?? '' }}</h6></td>
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
                                    <form method="POST" action="{{ route('admin.transactions.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="basic-form">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label"><h6> Pay :</h6></label>
                                                    <div class="col-sm-8">
                                                        <input type="string" class="form-control sum" name="pay" id="pay">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label"><h6>Change :</h6></label>
                                                    <div class="col-sm-8">
                                                        @foreach($transactionOrder as $orderProducts)
                                                            <input type="hidden" name="product_name[]" value="{{ $orderProducts->products->name }}">
                                                            <input type="hidden" name="product_price[]" value="{{ $orderProducts->products->price }}">
                                                            <input type="hidden" name="quantity_products[]" value="{{ $orderProducts->quantity }}">
                                                            <input type="hidden" name="total_price[]" value="{{ $orderProducts->products->price * $orderProducts->quantity }}">
                                                        @endforeach
                                                        <input type="string" class="form-control" name="result" id="result" disabled>
                                                        <input type="hidden" name="change" id="change">
                                                        <input type="hidden" name="transaction_total_price" value="{{ $totalPrice ?? 0 }}">
                                                        <input type="hidden" name="transaction_total_quantity" value="{{ $totalQuantity ?? 0 }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        </div>
                                        <div class="col-lg-2">
                                            <h6> Total Price </h6>
                                            <h5> Rp. {{ number_format($totalPrice, 2, ",", ".") ?? 0 }} </h5>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary btn-rounded">Submit Order</button>
                                        </div>
                                    </div>
                                    </br>
                                    </form>
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
            <script>
            $('.sum').on('input', function() {
                var pay = parseFloat($("#pay").val());
                var totalPrice = {{ $totalPrice ?? 0 }};
                var change = pay - totalPrice;
                $("#result").val(change);
                $("#change").val(change);
            });
            </script>
        @endpush