@extends('layouts.morss.app')

@section('styles')
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- bootstrap-datetimepicker -->
<link href="{{ asset('gentelella/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Create Survey</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/morss') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/morss/survey') }}">Survey</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<br>
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daterange of the survey</h4>
                {!! Form::open(['url' => url('morss/survey')]) !!}
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-3 col-form-label">From</label>
                        <div class="col-md-9">
                            <select class="select2 form-control custom-select" required>
                                <option>Select</option>
                                @foreach($months as $month)
                                    <option value="{{ $month->id }}">{{ $month->month_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-3 col-form-label">To</label>
                        <div class="col-md-9">
                            <select class="select2 form-control custom-select" required>
                                <option>Select</option>
                                @foreach($months as $month)
                                    <option value="{{ $month->id }}">{{ $month->month_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-3 col-form-label">Year</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control datetimepicker_year" name="year" placeholder="Select" required>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Questions</h4>
                <h6 class="card-subtitle"> Lurem Ipsum Dolor </h6>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('gentelella/vendors/moment/min/moment.min.js') }}"></script>
<!-- bootstrap-datetimepicker -->    
<script src="{{ asset('gentelella/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
    jQuery(document).ready(function() {
        // For select 2
        $(".select2").select2();
    });
</script>
<script>
    $('.datetimepicker_year').datetimepicker({
        viewMode: 'years',
        format: 'YYYY'
    });
</script>
@endsection