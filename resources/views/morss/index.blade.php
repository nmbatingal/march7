@extends('layouts.morss.app')

@section('styles')
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
<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="text-white">Morale Survey Index</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body p-0">
                                <h4 class="card-title">OI% of DOST Caraga for <a href="javascript:void(0)">{{ $semesters->first()->semesterRangeFormal }}</a></h4>
                                <div>
                                    <canvas id="barChart" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">

                        <div class="card">
                            <div class="card-body b-all">
                                <h4 class="card-title"><i class="mdi mdi-calendar"></i> {{ Carbon\Carbon::now()->format('d M') }}</h4>
                                <div class="text-right"> <span class="text-muted">Todays Date</span>
                                    <h1 class="font-light"><sup><i class="ti-arrow-up text-info"></i></sup> $5,000</h1>
                                </div>
                                <span class="text-info">30%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 30%; height: 6px;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
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
        </div>
    </div>
    <!-- column -->
</div>
@endsection

@section('scripts')
<!-- Chart JS -->
<script src="{{ asset('vendor/bower/chart.js/dist/Chart.min.js') }}"></script>
<!-- Chart.js plugin -->
<script src="{{ asset('vendor/bower/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js') }}"></script>
<script src="{{ asset('vendor/bower/chartjs-plugin-annotation/chartjs-plugin-annotation.min.js') }}"></script>
<script type="text/javascript">
    // This is for the sticky sidebar    
    $(".stickyside").stick_in_parent({
        offset_top: 100
    });
</script>
<script type="text/javascript">
    var overallIndex         = {!! json_encode($overallIndex) !!};
    var divisionOverallIndex = {!! json_encode($division_data) !!};
    var dataLabels = [];
    var dataValue  = [];

    $.each( divisionOverallIndex, function (index, value) {
        dataLabels.push(value.name);
        dataValue.push(value.oi_value);
    });

    var moraleChart = document.getElementById("barChart");
    var myChart = new Chart(moraleChart, {
        type: 'bar',
        data: {
            // labels: ["Overall Index", "Blue", "Yellow", "Green", "Purple"],
            labels: dataLabels,
            datasets: [{
                label: '# of Votes',
                // data: [ overallIndex , 19, 3, 5, 2],
                data: dataValue,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255,99,132,1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)', 
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1,
                datalabels: {
                    anchor: 'start',
                    align: 'end'
                }
            }],
        },
        options: {
            legend: { display: false },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        max: 100
                    }
                }]
            }
        }
    });
</script>
@endsection