<!DOCTYPE html>
<html>
<head>
    <title>Laporan Modal Usaha</title>
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
            border: 0px solid #ccc;
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
            <h1>Warungnya Eyang</h1>
            <h3>Laporan Modal Usaha</h3>
            <h3>Periode {{ $periode }}</h3>
        </div>
        <div class="receipt-body">
            <table>
                <tbody>
                        <tr>
                            <td><b>Pendapatan</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Pendapatan Total Penjualan</td>
                            <td></td>
                            <td><center>Rp. {{ number_format($sumTotalPrices, 2, ",", ".") }}</center></td>
                        </tr>
                        @foreach($incomes as $index => $income)
                        <tr>
                            <td>{{ $income->transactionCategory->category }}</td>
                            <td></td>
                            <td><center>Rp. {{ number_format($income->total, 2, ",", ".") }}</center></td>
                        </tr>
                        @endforeach
                        <tr style="background-color:lime;">
                            <td><b>Total Pendapatan</b></td>
                            <td></td>
                            <td><center><b>Rp. {{ number_format($sumIncomes + $sumTotalPrices, 2, ",", ".") }}</center></b></td>
                        </tr>
                        <tr>
                            <td><b>Pengeluaran</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach($expenses as $index => $expense)
                        <tr>
                            <td>Pengeluaran {{ $expense->transactionCategory->category }}</td>
                            <td><center>Rp. {{ number_format($expense->total, 2, ",", ".") }}</center></td>
                            <td></td>
                        </tr>
                        @endforeach
                </tbody>
                <tfoot>
                    <tr style="background-color:red;">
                        <td colspan="1"><b>Total Pengeluaran</b></td>
                        <td><center><b>Rp. {{ number_format($sumExpenses, 2, ",", ".") }}</b></center></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="1"><b>Keuntungan Bersih</b></td>
                        <td></td>
                        <td><center><b>Rp. {{ number_format($sumIncomes + $sumTotalPrices - $sumExpenses, 2, ",", ".") }}</center></b></td>
                    </tr>
                    <tr>
                        <td colspan="1"><b>Saldo Modal Awal</b></td>
                        <td></td>
                        <td><center><b>Rp. {{ number_format($cashBalance->initial_cash ?? 0, 2, ",", ".") }}</center></b></td>
                    </tr>
                    <tr style="background-color:yellow;">
                        <td colspan="1"><b>Saldo Modal Akhir</b></td>
                        <td></td>
                        <td><center><b>Rp. {{ number_format($sumIncomes + $sumTotalPrices - $sumExpenses + ($cashBalance->initial_cash ?? 0), 2, ",", ".") }}</center></b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        </div>
    </body>
</html>