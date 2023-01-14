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
            <p align="left">Address : Jl. Teratai, Srengseng Sawah, Kec. Jagakarsa, Kota Jakarta Selatan</p>
            <p align="left">Phone : 082213686190</p><br>
            <p align="left">Transaction Code: {{ $transaction->transaction_code }}</p>
            <p align="left">Date: {{ $transaction->created_at }}</p>
        </div>
        <div class="receipt-body">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->transactionProducts as $index => $products)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $products->product_name }}</td>
                        <td>Rp. {{ number_format($products->price, 2, ",", ".") }}</td>
                        <td>{{ $products->quantity }}</td>
                        <td>Rp. {{ number_format($products->total_price, 2, ",", ".") }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><b>Total Price</b></td>
                        <td>Rp. {{ number_format($transaction->transaction_total_price, 2, ",", ".") }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><b>Pay</b></td>
                        <td>Rp. {{ number_format($transaction->pay, 2, ",", ".") }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><b>Change</b></td>
                        <td>Rp. {{ number_format($transaction->change, 2, ",", ".") }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
            <div class="receipt-footer">
                <p>Thanks for coming, we'll wait for your repeat order!</p>
            </div>
        </div>
    </body>
</html>