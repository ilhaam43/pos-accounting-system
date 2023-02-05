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
                            <h4>List Pengguna</h4>
                            <span class="ml-1"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">List Pengguna</a></li>
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
                                <h4 class="card-title">List Pengguna</h4>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#basicModal">Tambah Pengguna</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="basicModal">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambah Pengguna</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('owner.users.store')}}" enctype="multipart/form-data">
                                                @csrf
                                                    <h6> Nama : </h6>
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="name" required>
                                                    </div>
                                                    <h6> Password : </h6>
                                                    <div class="form-group">
                                                        <input class="form-control" type="password" name="password" required>
                                                    </div>
                                                    <h6> Konfirmasi Password : </h6>
                                                    <div class="form-group">
                                                        <input class="form-control" type="password" name="confirm_password" required>
                                                    </div>
                                                    <h6> Email : </h6>
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="email" required>
                                                    </div>
                                                    <h6> Role : </h6>
                                                    <select type="text" class="form-control" name="role" required>
                                                    <option selected>Pilih Tipe...</option>
                                                            <option value="owner">Owner</option>
                                                            <option value="admin">Admin</option>
                                                    </select>
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
                                                <th>Nama</th>
                                                <th>Email</th>
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
        @include('owner.user.ajax.deleteUserAjax')
        @include('owner.user.ajax.showUserAjax')
            <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
        @endpush
        