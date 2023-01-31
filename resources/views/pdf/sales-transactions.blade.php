<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <style>
        /* CSS styles for receipt layout */
        /* You can add your own styles here */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .receipt {
            width: 700px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-header img {
            width: 10px;
            height: 10px;
        }

        /* Add a logo to the receipt header */
        .receipt-header img {
            width: 10px;
            height: auto;
            margin-bottom: 10px;
        }

        .receipt-header h1 {
            margin: 0;
            font-size: 18px;
        }

        .receipt-header p {
            margin: 0;
            font-size: 14px;
        }

        .receipt-body {
            margin-bottom: 20px;
        }

        .receipt-body table {
            width: 100%;
            border-collapse: collapse;
        }

        .receipt-body table th,
        .receipt-body table td {
            border: 1px solid #ccc;
            padding: 5px;
        }

        .receipt-footer {
            text-align: right;
        }

        .receipt-footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="receipt-header">
            <h1></h1>
            <h1>Laporan Transaksi Penjualan</h1><br>
            <p align="left">Periode : {{ $periode }}</p>
        </div>
        <div class="receipt-body">
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Menu</th>
                        <th width="20%">Total Kuantitas Penjualan</th>
                        <th>Total Pendapatan Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($salesTransaction as $index => $menus)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $menus->menu_name }}</td>
                            <td>{{ $menus->quantitys }}</td>
                            <td>Rp. {{ number_format($menus->total_prices, 2, ",", ".") }}</td>
                        </tr>
                        @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><b>Total :</b></td>
                        <td>{{ $sumTotalQuantity }}</td>
                        <td>Rp. {{ number_format($sumTotalPrices, 2, ",", ".") }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        </div>
    </body>
</html>