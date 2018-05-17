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
@endsection