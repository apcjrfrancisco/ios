@extends('layouts.admin')
@section('admin')

@section('title', 'TM Charts')


<div class="row">
    <div class="col-md-6">
        <div id="totalSold" style="width: 900px; height: 500px;"></div>
    </div>
    <div class="col-md-6">
        <div id="ProductAmount" style="width: 900px; height: 500px;"></div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Product Name', 'Total Sold'],
            <?php echo $chartTotalSold; ?>
        ]);

        var options = {
            title: 'Best Sold Products',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('totalSold'));

        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Product', 'Amount'],
            <?php echo $chartAmountSold; ?>
        ]);

        var options = {
            title: 'Amount Sold Per Product',
            curveType: 'function',
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.BarChart(document.getElementById('ProductAmount'));

        chart.draw(data, options);
    }
</script>

@endsection
