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
                            <h4>Transaction List</h4>
                            <span class="ml-1"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Transaction List</a></li>
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
                                <h4 class="card-title">Transaction List</h4>
                                <!-- Button trigger modal -->
                                <a href="{{ route('admin.transactions.create') }}" class="btn btn-rounded btn-primary">Create Transaction</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTable" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Product Image</th>
                                                <th>Product Name</th>   
                                                <th>Price</th>
                                                <th>Action</th>
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
        @include('admin.product.ajax.deleteProductAjax')
        @include('admin.product.ajax.showProductAjax')
            <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
        @endpush