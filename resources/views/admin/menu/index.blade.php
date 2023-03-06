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
                            <h4>List Menu Makanan & Minuman</h4>
                            <span class="ml-1"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">List Menu Makanan & Minuman</a></li>
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
                                <h4 class="card-title">List Menu Makanan & Minuman</h4>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#basicModal">Tambah Menu</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="basicModal">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambah Menu</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('admin.menus.store')}}" enctype="multipart/form-data">
                                                @csrf
                                                    <h6> Nama : </h6>
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="name" required>
                                                    </div>
                                                    <h6> Harga : </h6>
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="price" id="price" required>
                                                    </div>
                                                    <h6> Kategori : </h6>
                                                    <div class="form-group">
                                                        <select type="text" class="form-control" name="category" required>
                                                                <option value="Makanan">Makanan</option>
                                                                <option value="Minuman">Minuman</option>
                                                        </select>
                                                    </div>
                                                    <h6> Gambar : </h6>
                                                    <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="menu_image" required>
                                                            <label class="custom-file-label">Pilih Gambar</label>
                                                        </div>
                                                    </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary btn-rounded">Simpan</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTable" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Gambar</th>
                                                <th>Kategori</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
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
            <!-- Datatable -->
        @include('admin.menu.ajax.deleteMenuAjax')
        @include('admin.menu.ajax.showMenuAjax')
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
        