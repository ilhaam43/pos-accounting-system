@extends('owner.layout.template')
@section('content') 
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Total Pengguna</div>
                                    <div class="stat-digit">{{ $user }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Total Saldo Kas Saat Ini</div>
                                    <div class="stat-digit">Rp. {{ number_format($cashBalance->ending_cash ?? 0, 0, ",", ".") }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Total Pemasukan Bulan Ini</div>
                                    <div class="stat-digit">Rp. {{ number_format($income ?? 0, 0, ",", ".") }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Total Pengeluaran Bulan Ini</div>
                                    <div class="stat-digit">Rp. {{ number_format($expense ?? 0, 0, ",", ".") }}</div>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <div class="col-lg-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Statistik Total Pendapatan Transaksi Penjualan Per Bulan Dalam Jutaan Rupiah</h4>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="lineChart_1"></canvas>
                                    </div>
                                </div>
                            </div>
                    <!-- /# column -->
                </div>
                
                    </div>
                </div>

            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        @push('custom-scripts')
        <!-- Chart ChartJS plugin files -->
        <script src="{{asset('vendor/chart.js/Chart.bundle.min.js')}}"></script>
        @include('owner.js.linechart')
        @endpush
        @endsection