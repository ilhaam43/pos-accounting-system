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
                            <h4>Edit Data Pengguna</h4>
                            <span class="ml-1"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Data Pengguna</a></li>
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
                                <h4 class="card-title">Edit Pengguna Data</h4>
                            </div>
                            <div class="card-body">
                            <div class="basic-form">
                                    <form method="POST" action="{{ route('owner.users.update', $user->id )}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Nama :</label>
                                                <input type="text" class="form-control" value="{{$user->name}}" name="name">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Email :</label>
                                                <input type="text" class="form-control" value="{{$user->email}}"name="email">
                                            </div>
                                            <div class="form-group col-md-4">
                                            <h6> Role : </h6>
                                                    <select type="text" class="form-control" name="role" required>
                                                    <option selected>Pilih Tipe...</option>
                                                            <option value="owner">Owner</option>
                                                            <option value="admin">Admin</option>
                                                    </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Password :</label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Konfirmasi Password :</label>
                                                <input type="password" class="form-control" name="konfirmasi_password">
                                            </div>
                                        </div>
                                        <a href="{{route('owner.users.index')}}" class="btn btn-danger btn-rounded">Batal</a>
                                        <button type="submit" class="btn btn-primary btn-rounded">Simpan</button>
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
        @endpush
        