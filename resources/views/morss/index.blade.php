@extends('layouts.morss.app')

@section('styles')
<!--c3 CSS -->
<link href="{{ asset('dist/css/pages/easy-pie-chart.css') }}" rel="stylesheet">
<style type="text/css">
    .card-body.b-all {
        border: 1px solid #03a9f3;
    }
</style>
@endsection

@section('content')
<!--  <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Dashboard</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Starter Page</li>
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
        </div>
    </div> 
</div> -->
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<br>

@hasanyrole(['System Administrator', 'Unit Head'])
<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="">OI% of DOST Caraga for <a href="javascript:void(0)">{!! !$semesters->isEmpty() ? $semesters->first()->semesterRangeFormal : '<a href="#">n/a</a>' !!}</a></h4>
                    </div>
                    <div class="card-body">
                        <div>
                            <canvas id="barChart" height="150"></canvas>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-2 col-sm-4 col-xs-12 text-center">
                                <div class="chart easy-pie-chart-2" data-percent="{{ $percentSurveyed }}"> <span class="percent"></span>
                                    <br>
                                    <h4>Accounts Surveyed</h4>
                                    <canvas height="100" width="100"></canvas>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="card m-t-40">
                    <div class="card-body">
                        <h6 class="card-title">Morale Index percentage per questions asked.</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question</th>
                                        <th>Index Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $questions as $i => $question )
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $question['question'] }}</td>
                                            <td align="center">
                                                <span class="text-primary font-bold">{{ $question['value'] }}%</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body b-all">
                        <div class="carousel slide" data-ride="carousel">
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                <div class="carousel-item active flex-column">
                                    <h4 class="card-title"><i class="mdi mdi-calendar"></i> {{ Carbon\Carbon::now()->format('d M') }}</h4>
                                    <div class="text-right"> <span class="text-muted">Accounts Surveyed</span>
                                        <h1 class="font-light"><span class="text-info"></span>{!! $totalSurveyed->total !!}<sub>/{!! $totalUsers !!}</sub></h1>
                                    </div>
                                    <span class="text-info">{{ $percentSurveyed }}%</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $percentSurveyed }}%; height: 6px;" aria-valuenow="{{ $percentSurveyed }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card stickyside">
                    <div class="card-header bg-info">
                        <h4 class="m-b-0 text-white">Legend</h4>
                    </div>
                    <div class="card-body b-all">
                        <ul class="list-style-none">
                            <li class="box-label"><a href="javascript:void(0)">Very positive and favorable <span class="font-bold text-success pull-right">76 - 100%</span></a></li>
                            <li class="box-label"><a href="javascript:void(0)">Positive and favorable <span class="font-bold text-info pull-right">51 - 75%</span></a></li>
                            <li class="box-label"><a href="javascript:void(0)">Negative and unfavorable <span class="font-bold text-warning pull-right">26 - 50%</span></a></li>
                            <li class="box-label"><a href="javascript:void(0)"> Very negative and unfavorable <span class="font-bold text-danger pull-right">0 - 25%</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- column -->
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                This is the <strong>Morale Survey System</strong>!
                <p> Take the <a href="{{ url('/morss/survey/takesurvey') }}">survey</a> to proceed.</p>

            </div>
        </div>
    </div>
</div>
@endhasanyrole

@endsection

@section('scripts')
<!-- Chart JS -->
<script src="{{ asset('vendor/bower/chart.js/dist/Chart.min.js') }}"></script>
<!-- Chart.js plugin -->
<script src="{{ asset('vendor/bower/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js') }}"></script>
<script src="{{ asset('vendor/bower/chartjs-plugin-annotation/chartjs-plugin-annotation.min.js') }}"></script>
<!-- EASY PIE CHART JS -->
<script src="{{ asset('assets/node_modules/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/jquery.easy-pie-chart/easy-pie-chart.init.js') }}"></script>
<script type="text/javascript">
    // This is for the sticky sidebar    
    $(".stickyside").stick_in_parent({
        offset_top: 100
    });
</script>
<script type="text/javascript">
    var divisionOverallIndex = {!! json_encode($division_data) !!};
    var dataLabels = [];
    var dataValue  = [];

    $.each( divisionOverallIndex, function (index, value) {
        dataLabels.push(value.name);
        dataValue.push(value.oi_value['data']);
    });

    var randomColorPlugin = {
        beforeInit: function(chart) {
            var backgroundColor = [];
            var borderColor = [];
            var data = chart.config.data.datasets[0].data;

            $.each(data, function(n, currentElem) {

                if ( currentElem >= 76 ) {
                    var color  = 'rgba(75, 192, 192, 0.2)'; // green
                    var border = 'rgba(75, 192, 192, 1)'; // green
                } else if ( currentElem >= 51 ) {
                    var color  = 'rgba(54, 162, 235, 0.2)'; // blue
                    var border = 'rgba(54, 162, 235, 1)'; // blue
                } else if ( currentElem >= 26 ) {
                    var color  = 'rgba(255, 206, 86, 0.2)'; // orange
                    var border = 'rgba(255, 206, 86, 1)'; // orange
                } else {
                    var color  = 'rgba(255, 99, 132, 0.2)'; // red
                    var border = 'rgba(255,99,132,1)'; // red
                }

                backgroundColor.push(color);
                borderColor.push(border);
            });
            
            // We update the chart bars color properties
            chart.config.data.datasets[0].backgroundColor = backgroundColor;
            chart.config.data.datasets[0].borderColor     = borderColor;
        }
    };

    Chart.pluginService.register(randomColorPlugin);

    var moraleChart = document.getElementById("barChart");
    var myChart = new Chart(moraleChart, {
        type: 'bar',
        data: {
            labels: dataLabels,
            datasets: [{
                data: dataValue,
                borderWidth: 1,
                datalabels: {
                    anchor: 'start',
                    align: 'end'
                }
            }],
        },
        options: {
            legend: { display: false },
            tooltips: {
                enabled: true,
                mode: 'label',
                position: 'average',
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.yLabel + "%";
                    }
                }
            },
            title: {
                display: true,
                text: 'Overall Index (OI) percentage based on Conducted Morale Survey ',
                position: 'bottom'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        max: 100
                    }
                }]
            },
            annotation: {
                drawTime: 'afterDraw', // overrides annotation.drawTime if set
                annotations: [{
                    id: 'very-negative', // optional
                    type: 'line',
                    mode: 'horizontal',
                    scaleID: 'y-axis-0',
                    value: 26,
                    borderColor: 'orange',
                    borderWidth: 1,   
                    borderDash: [4, 4],    
                    label: false
                }, {
                    id: 'negative', // optional
                    type: 'line',
                    mode: 'horizontal',
                    scaleID: 'y-axis-0',
                    value: 51,
                    borderColor: 'blue',
                    borderWidth: 1,   
                    borderDash: [4, 4],    
                    label: false
                }, {
                    id: 'positive', // optional
                    type: 'line',
                    mode: 'horizontal',
                    scaleID: 'y-axis-0',
                    value: 76,
                    borderColor: 'green',
                    borderWidth: 1,   
                    borderDash: [4, 4],    
                    label: false
                }],
            },
            plugins: {
                datalabels: {
                    backgroundColor: false,
                    borderColor: false,
                    formatter: function(value, context) {
                        if ( value > 0 ) {
                            return value + '%';
                        } else {
                            return 0 + '%';
                        }
                    },
                    borderRadius: 4,
                }, 
            },
        }
    });
</script>
@endsection