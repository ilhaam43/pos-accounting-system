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
                            <h4>Transaksi Pesanan Penjualan</h4>
                            <span class="ml-1"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Transaksi Pesanan Penjualan</a></li>
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
                            <form>
                            @csrf
                            <div class="card-body">
                                <h6>Pilih kategori :</h6>
                                <div class="form-group mb-2">
                                            <label class="sr-only">Pilih Kategori</label>
                                            <select id="category" type="text" class="form-control" name="menu_id" required>
                                                <option value="Makanan">Makanan</option>
                                                <option value="Minuman">Minuman</option>
                                            </select>
                                </div>
                            </form>
                            <div class="basic-form">
                                <form class="form-inline" method="POST" action="{{ route('admin.sales-transactions.order.store') }}">
                                @csrf
                                        <div class="form-group mb-2">
                                            <label class="sr-only">Menu</label>
                                            <select type="text" class="form-control" name="menu_id" id="items" required>
                                            </select>
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label class="sr-only">Quantity</label>
                                            <input type="number" name="quantity" class="form-control" placeholder="Kuantitas" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-rounded mb-2">Tambah Pesanan</button>
                                </form>
                            </div>
                            </br>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th width="5%">No.</th>
                                                <th scope="col">Gambar Menu</th>
                                                <th scope="col">Nama Menu</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Kuantitas</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Jumlah Harga</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @csrf
                                            @foreach($salesTransactionOrder as $orders)
                                            <tr>
                                                <th>{{ ++$i }}</th>
                                                <td><img src="{{asset($orders->menu->image)}}" width="120" height="120"></td>
                                                <td><h6>{{ $orders->menu->name }}</h6></td>
                                                <td><h6>{{ $orders->quantity }}</h6></td>
                                                <td><h6>{{ $orders->category }}</h6></td>
                                                <td><h6>Rp. {{ number_format($orders->menu->price, 2, ",", ".") ?? 0 }}</h6></td>
                                                <td><h6>Rp. {{ number_format($orders->menu->price * $orders->quantity, 2, ",", ".") ?? '' }}</h6></td>
                                                <td>
                                                <form onsubmit="return confirm('Apakah anda yakin ingin menghapus menu ini ?');" action="{{ route('admin.sales-transactions.order.destroy', $orders->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <form method="POST" action="{{ route('admin.sales-transactions.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="basic-form">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label"><h6> Bayar :</h6></label>
                                                    <div class="col-sm-8">
                                                        <input type="string" class="form-control sum" name="pay" id="pay">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label"><h6> Kembali :</h6></label>
                                                    <div class="col-sm-8">
                                                        @foreach($salesTransactionOrder as $orderMenus)
                                                            <input type="hidden" name="menu_name[]" value="{{ $orderMenus->menu->name }}">
                                                            <input type="hidden" name="menu_price[]" value="{{ $orderMenus->menu->price }}">
                                                            <input type="hidden" name="quantity_menus[]" value="{{ $orderMenus->quantity }}">
                                                            <input type="hidden" name="total_price[]" value="{{ $orderMenus->menu->price * $orderMenus->quantity }}">
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
                                            <button type="submit" class="btn btn-primary btn-rounded">Tambah Pesanan</button>
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
                const itemSelect = document.getElementById("items");

                document.getElementById("category").addEventListener("change", (event) => {
                const selectedCategory = event.target.value;

                fetch(`/ajax/menus/${selectedCategory}`)
                    .then(response => response.json())
                    .then(data => {
                    populateItems(data);
                    })
                    .catch(error => console.error(error));
                });

                function populateItems(items) {
                itemSelect.innerHTML = "";

                items.forEach((item) => {
                    const option = document.createElement("option");
                    option.value = item.id;
                    option.text = item.name;
                    itemSelect.appendChild(option);
                });
                }
            </script>
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