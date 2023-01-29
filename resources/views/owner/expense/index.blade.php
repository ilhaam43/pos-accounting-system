@extends('owner.layout.template')
@section('content')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>List Transaksi Pengeluaran</h4>
                            <span class="ml-1"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">List Transaksi Pengeluaran</a></li>
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
                                <h4 class="card-title">List Transaksi Pengeluaran</h4>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#basicModal">Tambah Pengeluaran</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="basicModal">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambah Pengeluaran</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('owner.expenses.store')}}" enctype="multipart/form-data">
                                                @csrf
                                                    <h6> Kategori : </h6>
                                                    <div class="form-group">
                                                        <select type="text" class="form-control" name="category_id" required>
                                                        <option selected>Pilih Kategori...</option>
                                                            @foreach($transactionCategory as $categories) 
                                                                <option value="{{$categories->id}}">{{$categories->category}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <h6> Deskripsi : </h6>
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="description" required>
                                                    </div>
                                                    <h6> Nominal : </h6>
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="value" required>
                                                    </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
                                                <th>Kategori</th>
                                                <th>Deskripsi</th>
                                                <th>Nominal</th>
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
        @include('owner.expense.ajax.deleteExpenseAjax')
        @include('owner.expense.ajax.showExpenseAjax')
            <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
        @endpush
        