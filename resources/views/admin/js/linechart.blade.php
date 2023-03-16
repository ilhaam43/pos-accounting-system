<script>
(function($) {
    "use strict"
    
    let draw = Chart.controllers.line.__super__.draw; //draw shadow
    var countTransactions = {{ $countSalesTransactionByMonth }}
    var countIncomes = {{ $countIncomeSalesTransactionByMonth }}

    //basic line chart
    const lineChart_1 = document.getElementById("lineChart_1").getContext('2d');

    Chart.controllers.line = Chart.controllers.line.extend({
        draw: function () {
            draw.apply(this, arguments);
            let nk = this.chart.chart.ctx;
            let _stroke = nk.stroke;
            nk.stroke = function () {
                nk.save();
                nk.shadowColor = 'rgba(255, 0, 0, .2)';
                nk.shadowBlur = 10;
                nk.shadowOffsetX = 0;
                nk.shadowOffsetY = 10;
                _stroke.apply(this, arguments)
                nk.restore();
            }
        }
    });
    
    lineChart_1.height = 100;

    new Chart(lineChart_1, {
        type: 'line',
        data: {
            defaultFontFamily: 'Poppins',
            labels: ['Januari', 'Februari', 'Maret', 'April',
            'Mei', 'Juni', 'Juli', 'Agustus',
            'September', 'Oktober', 'November', 'Desember',],
            datasets: [
                {
                    label: "Transaksi Penjualan Dalam Jutaan Rupiah",
                    data: countIncomes,
                    borderColor: 'rgba(56, 164, 248, 1)',
                    borderWidth: "2",
                    backgroundColor: 'transparent',  
                    pointBackgroundColor: 'rgba(56, 164, 248, 1)'
                }
            ]
        },
        options: {
            legend: false, 
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true, 
                        max: 10, 
                        min: 0, 
                        stepSize: 20, 
                        padding: 10
                    }
                }],
                xAxes: [{
                    ticks: {
                        padding: 5
                    }
                }]
            }
        }
    });
})(jQuery);
</script>