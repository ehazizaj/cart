@extends('admin.layouts.app')

@section('title', 'Home')

@section('head_assets')
    <script type="text/javascript" src="{{asset('assets/js/core/app.js')}}"></script>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header page-header-default">
            <div class="page-header-content">
                <div class="page-title">
                    <h4>
                        <i class="icon-arrow-left52 position-left"></i>
                        <span class="text-semibold">Dashboard</span>
                        </h4>
                    <ul class="breadcrumb position-right">
                        <li>
                            <a href="">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content">
            <div id="chart_div" style="width: auto; height: 500px;"></div>
        </div>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawMultSeries);

        function drawMultSeries() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Expectation');
            data.addColumn('number', 'Reality');

            data.addRows([
                ['January', 5, {{$users[1]}}],
                ['February', 8, {{$users[2]}}],
                ['March', 10, {{$users[3]}}],
                ['April', 12, {{$users[4]}}],
                ['May', 13, {{$users[5]}}],
                ['June', 14, {{$users[6]}}],
                ['July', 15, {{$users[7]}}],
                ['August', 17, {{$users[8]}}],
                ['September', 10, {{$users[9]}}],
                ['October', 8, {{$users[10]}}],
                ['November', 7, {{$users[11]}}],
                ['December', 2, {{$users[12]}}],
            ]);

            var dateTicks = [];
            for (var m = 1; m <= 12; m++)
                dateTicks.push(new Date(new Date().getFullYear() + '-' + m + '-1'));

            var options = {
                hAxis: {
                    title: 'Monthly Registration',
                    format: 'MMMM',
                    ticks: dateTicks
                },
                vAxis: {
                    title: 'Rating Scale'
                }
            };

            var chart = new google.visualization.ColumnChart(
                document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>
@endsection
