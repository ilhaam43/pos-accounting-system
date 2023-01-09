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
                            <h4>Edit Product Data</h4>
                            <span class="ml-1"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Product Data</a></li>
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
                                <h4 class="card-title">Edit Product Data</h4>
                            </div>
                            <div class="card-body">
                            <div class="basic-form">
                                    <form method="POST" action="{{ route('admin.products.update', $product->id )}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Product Name</label>
                                                <input type="text" class="form-control" value="{{$product->name}}" name="name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Product Price</label>
                                                <input type="number" class="form-control" value="{{$product->price}}"name="price">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Product Image</label>
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="product_image">
                                                            <label class="custom-file-label">Choose file</label>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <a href="{{route('admin.products.index')}}" class="btn btn-danger">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
            <!-- Datatable -->
            <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
            
            <script>
            function formatRupiah(angka, prefix){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split           = number_string.split(','),
                sisa            = split[0].length % 3,
                rupiah          = split[0].substr(0, sisa),
                ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
        
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
        
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }
        
            // menyiapkan element input dengan id price
            var price = document.getElementById('price');
        
            // menambahkan event keyup
            price.addEventListener('keyup', function(e){
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format rupiah
                price.value = formatRupiah(this.value, 'Rp. ');
            });
        </script>
        @endpush
        