@extends('layouts.morss.app')

@section('styles')
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Dashboard</h4>
    </div>
    <!-- <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Starter Page</li>
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
        </div>
    </div> -->
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <!-- column -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Morale Survey Index</h4>
                <div>
                    <canvas id="barChart" height="150"></canvas>
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
    var overallIndex = {!! json_encode($overallIndex) !!};
    console.log(overallIndex);

    var moraleChart = document.getElementById("barChart");
    var myChart = new Chart(moraleChart, {
        type: 'bar',
        data: {
            labels: ["OI", "Blue", "Yellow", "Green", "Purple"],
            datasets: [{
                label: '# of Votes',
                data: [ overallIndex , 19, 3, 5, 2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
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
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
@endsection