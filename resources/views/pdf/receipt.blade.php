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
        <img src="images/logo warungnya eyang.jpeg" width="70" height="80" style="margin: auto 5px;
    float: left;" alt="Logo">
            <h1></h1>
            <h1>Warungnya Eyang</h1><br>
            <p align="left">Alamat : Jl. Teratai, Srengseng Sawah, Kec. Jagakarsa, Kota Jakarta Selatan</p>
            <p align="left">No HP : 082213686190</p><br>
            <p align="left">Kode Transaksi : {{ $salesTransaction->transaction_code }}</p>
            <p align="left">Tanggal : {{ $salesTransaction->created_at }}</p>
        </div>
        <div class="receipt-body">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Kuantitas</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salesTransaction->salesTransactionDetail as $index => $menus)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $menus->menu_name }}</td>
                        <td>Rp. {{ number_format($menus->price, 2, ",", ".") }}</td>
                        <td>{{ $menus->quantity }}</td>
                        <td>Rp. {{ number_format($menus->total_price, 2, ",", ".") }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><b>Total Harga</b></td>
                        <td>Rp. {{ number_format($salesTransaction->transaction_total_price, 2, ",", ".") }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><b>Bayar</b></td>
                        <td>Rp. {{ number_format($salesTransaction->pay, 2, ",", ".") }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><b>Kembalian</b></td>
                        <td>Rp. {{ number_format($salesTransaction->change, 2, ",", ".") }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        </div>
    </body>
</html>