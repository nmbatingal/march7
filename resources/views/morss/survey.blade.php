@extends('layouts.morss.app')

@section('styles')
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- bootstrap-datetimepicker -->
<link href="{{ asset('gentelella/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Survey</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/morss') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Survey</li>
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
    <div class="col-md-4">
        <div class="card stickyside">
            <div class="card-body">
                {!! Form::open([ 'url' => url('morss'), 'id' => 'form_create_semester' ]) !!}
                    <div class="form-body">
                        <h3 class="box-title">Semester Form</h3>
                        <h6 class="card-subtitle">Daterange of the survey to conduct </h6>
                        <hr class="m-t-0">
                        <div class="form-group m-b-25 row">
                            <label for="month_from" class="col-md-3 col-form-label">From</label>
                            <div class="col-md-9">
                                <select class="form-control form-control-line" name="month_from" required>
                                    <option value="">Select</option>
                                    @foreach ( $months as $month )
                                        <option value="{{ $month->id }}">{{ $month->month_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-b-25 row">
                            <label for="month_to" class="col-md-3 col-form-label">To</label>
                            <div class="col-md-9">
                                <select class="form-control" name="month_to" required>
                                    <option value="">Select</option>
                                    @foreach ( $months as $month )
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
                    </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Survey Table</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Survey Range</th>
                                <th>Date Created</th>
                                <th>Status</th>
                                <th class="text-nowrap text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $semesters as $semester )
                                <tr>
                                    <td>
                                        <a href="javascript:void(0)">
                                            {{ $semester->monthFrom->month_name }} - {{ $semester->monthTo->month_name }}, {{ $semester->year }}
                                        </a>
                                    </td>
                                    <td>{{ date("F d, Y", strtotime($semester->created_at)) }}</td>
                                    <td>
                                        @if ( $semester->status == 1 )
                                            <div class="label label-table label-success">Open</div>
                                        @else
                                            <div class="label label-table label-danger">Closed</div>
                                        @endif
                                    </td>
                                    <td class="text-nowrap" align="center">
                                        @if ( $semester->status == 1 )

                                            <button class="btn btn-xs btn-info waves-effect waves-light" data-toggle="tooltip" data-original-title="lock" onclick="document.getElementById('form-lock-{{ $semester->id }}').submit();"><i class="fa fa-lock"></i></button>
                                            {{ Form::open(['url' => url( 'morss/'.$semester->id.'/lock' ), 'id' => 'form-lock-'. $semester->id, 'style' => 'display: none;']) }}
                                            {{ Form::close() }}

                                        @else

                                            <button class="btn btn-xs btn-info waves-effect waves-light" data-toggle="tooltip" data-original-title="unlock" onclick="document.getElementById('form-unlock-{{ $semester->id }}').submit();"><i class="fa fa-unlock"></i></button>
                                            {{ Form::open(['url' => url( 'morss/'.$semester->id.'/unlock' ), 'id' => 'form-unlock-'. $semester->id, 'style' => 'display: none;']) }}
                                            {{ Form::close() }}

                                        @endif
                                        


                                        <button class="btn btn-xs btn-danger waves-effect waves-light" data-toggle="tooltip" data-original-title="remove" onclick="document.getElementById('form-remove-{{ $semester->id }}').submit();"><i class="fa fa-close"></i></button>
                                        {{ Form::open(['url' => url( 'morss/'.$semester->id ), 'id' => 'form-remove-'. $semester->id, 'method' => 'DELETE', 'style' => 'display: none;']) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
<!-- Custom Page JS -->
<script src="{{ asset('js/pages/morss/survey.js') }}"></script>
<script>
    jQuery(document).ready(function() {
        // For select 2
        $(".select2").select2();

        var flash     = {!! json_encode(session('toastr')) !!};
        if ( flash )
        {   
            $(flash).each(function (i) {
                $.toast({
                    heading: flash[0]['heading'],
                    text: flash[i]['text'],
                    icon: flash[i]['icon'],
                    position: 'bottom-left',
                    hideAfter: 5500,
                    //loader: false,
                    stack: 5
                });
            });
        }
    });
</script>
<script>
    // This is for the sticky sidebar    
    $(".stickyside").stick_in_parent({
        offset_top: 100
    });

    $('.datetimepicker_year').datetimepicker({
        viewMode: 'years',
        format: 'YYYY'
    });
</script>
@endsection