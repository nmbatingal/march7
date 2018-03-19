@extends('layouts.morss.app')

@section('styles')
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- bootstrap-datetimepicker -->
<link href="{{ asset('gentelella/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Question</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/morss') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/morss/survey') }}">Survey</a></li>
                <li class="breadcrumb-item active">Question</li>
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
                {!! Form::open(['url' => url('morss/survey '), 'id' => 'form_create_survey_question', 'class' => 'form-control-line']) !!}
                    <div class="form-body">
                        <h3 class="box-title">Question Form</h3>
                        <hr class="m-t-0">
                        <div class="form-group row">
                            <div class="col-md-12">
                                {!! Form::label('question', 'Question', ['class' => 'form-control-label']) !!}
                                {!! Form::textarea('question', null, ['id' => 'question', 'class' => 'form-control no-resize auto-growth', 'rows' => 1, 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Question</th>
                                <th class="text-nowrap text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $questions as $i => $question )
                                <tr>
                                    <td>
                                        {{ ++$i }}
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)">
                                            {!! $question->question !!}
                                        </a>
                                    </td>
                                    <td class="text-nowrap" align="center">
                                        {!! Form::open(['url' => url( 'morss/survey/'.$question->id ), 'method' => 'DELETE']) !!}
                                            {{ Form::button('<i class="fa fa-close"> </i>', ['class' => 'btn btn-xs btn-danger waves-effect waves-light', 'type' => 'submit']) }}
                                        {!! Form::close() !!}
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
<script>
    jQuery(document).ready(function() {
        // For select 2
        $(".select2").select2();

        // For auto resize text area
        autosize($('textarea.auto-growth'));

        // For sticky card
        $(".stickyside").stick_in_parent({
            offset_top: 100
        });

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
@endsection