@extends('layouts.morss.app')

@section('styles')
<!-- page css -->
<link href="{{ asset('dist/css/pages/ribbon-page.css') }}" rel="stylesheet">
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- bootstrap-datetimepicker -->
<link href="{{ asset('gentelella/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
<style>
    textarea  {
        background-color: #f8f9fa !important;
    }
</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Take Survey</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/morss') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/morss/survey/takesurvey') }}">Survey</a></li>
                <li class="breadcrumb-item active">Take Survey</li>
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
    <div class="col-md-3">
        <div class="card border-info stickyside">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Legend
                    <div class="card-actions text-white" style="font-size: 15px">
                        <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                    </div>
                </h4>
            </div>
            <div class="card-body p-0 collapse show">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong class="font-weight-bold">DN</strong></td>
                            <td>Definitely No</td>
                        </tr>
                        <tr>
                            <td><strong class="font-weight-bold">N</strong></td>
                            <td>No</td>
                        </tr>
                        <tr>
                            <td><strong class="font-weight-bold">NS</strong></td>
                            <td>Not Sure</td>
                        </tr>
                        <tr>
                            <td><strong class="font-weight-bold">Y</strong></td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td><strong class="font-weight-bold">DY</strong></td>
                            <td>Definitely Yes</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Morale Survey Form</h4>
            </div>
            @if ( $surveys->count() > 0 )
                <div class="card-body p-0">

                    <div class="form-group row p-20 m-b-0">
                        <label for="" class="col-md-3 col-form-label font-bold">Daterange of the survey</label>
                        <div class="col-md-3">
                            <input class="form-control disabled" type="text" value="{{ $semester->monthFrom->month_name }} - {{ $semester->monthTo->month_name }}, {{ $semester->year }}" readonly>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th class="text-nowrap text-center">DN</th>
                                    <th class="text-nowrap text-center">N</th>
                                    <th class="text-nowrap text-center">NS</th>
                                    <th class="text-nowrap text-center">Y</th>
                                    <th class="text-nowrap text-center">DY</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $surveys as $i => $survey )
                                    <tr>
                                        <td>
                                            {{ ++$i }}
                                        </td>
                                        <td>
                                            <div id="qn_1-error" class="badge badge-table badge-success"><i class="fa fa-check"></i></div> {!! $survey->question['question'] !!}
                                        </td>
                                        <td class="text-nowrap" align="center">
                                            <div class="custom-control custom-radio">
                                                {!! Form::radio($survey->id, 1, $survey->rate == 1 ? true : false, ['class' => 'custom-control-input', 'disabled']) !!}
                                                {!! Form::label($survey->id, ' ', ['class' => 'custom-control-label']) !!}
                                            </div>
                                        </td>
                                        <td class="text-nowrap" align="center">
                                            <div class="custom-control custom-radio">
                                                {!! Form::radio($survey->id, 2, $survey->rate == 2 ? true : false, ['class' => 'custom-control-input', 'disabled']) !!}
                                                {!! Form::label($survey->id, ' ', ['class' => 'custom-control-label']) !!}
                                            </div>
                                        </td>
                                        <td class="text-nowrap" align="center">
                                            <div class="custom-control custom-radio">
                                                {!! Form::radio($survey->id, 3, $survey->rate == 3 ? true : false, ['class' => 'custom-control-input', 'disabled']) !!}
                                                {!! Form::label($survey->id, ' ', ['class' => 'custom-control-label']) !!}
                                            </div>
                                        </td>
                                        <td class="text-nowrap" align="center">
                                            <div class="custom-control custom-radio">
                                                {!! Form::radio($survey->id, 4, $survey->rate == 4 ? true : false, ['class' => 'custom-control-input', 'disabled']) !!}
                                                {!! Form::label($survey->id, ' ', ['class' => 'custom-control-label']) !!}
                                            </div>
                                        </td>
                                        <td class="text-nowrap" align="center">
                                            <div class="custom-control custom-radio">
                                                {!! Form::radio($survey->id, 5, $survey->rate == 5 ? true : false, ['class' => 'custom-control-input', 'disabled']) !!}
                                                {!! Form::label($survey->id, ' ', ['class' => 'custom-control-label']) !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>  

                    <div class="form-group p-15">
                        <label class="font-bold">Remarks</label>
                        <blockquote>{!! $remarks->remarks !!}</blockquote>
                    </div> 
                </div>
            @else
                <div class="card-body p-0">

                    <div class="form-group row p-20 m-b-0">
                        <label for="" class="col-md-3 col-form-label font-bold">Daterange of the survey</label>
                        <div class="col-md-3">
                            <input class="form-control disabled" type="text" value="{{ $semester->monthFrom->month_name }} - {{ $semester->monthTo->month_name }}, {{ $semester->year }}" readonly>
                            {{ Form::hidden( 'semester_id', $semester->id, ['id' => 'semester_id'] ) }}
                            {{ Form::hidden( 'user_id', Auth::user()->id, ['id' => 'user_id'] ) }}
                        </div>
                    </div>

                    {!! Form::open(['url' => url('/morss/survey/takesurvey'), 'id' => 'form_take_survey']) !!}
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question</th>
                                        <th class="text-nowrap text-center">DN</th>
                                        <th class="text-nowrap text-center">N</th>
                                        <th class="text-nowrap text-center">NS</th>
                                        <th class="text-nowrap text-center">Y</th>
                                        <th class="text-nowrap text-center">DY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $questions as $i => $question )
                                        <tr>
                                            <td>
                                                {{ ++$i }}
                                                {{ Form::hidden( 'question_id[]', $question->id ) }}
                                            </td>
                                            <td>
                                                {!! $question->question !!}
                                            </td>
                                            <td class="text-nowrap" align="center">
                                                <div class="custom-control custom-radio">
                                                    {!! Form::radio('qn_'.$question->id, 1, false, ['id' => 'qn_1'.$question->id, 'class' => 'custom-control-input', 'required']) !!}
                                                    {!! Form::label('qn_1'.$question->id, ' ', ['class' => 'custom-control-label']) !!}
                                                </div>
                                            </td>
                                            <td class="text-nowrap" align="center">
                                                <div class="custom-control custom-radio">
                                                    {!! Form::radio('qn_'.$question->id, 2, false, ['id' => 'qn_2'.$question->id, 'class' => 'custom-control-input', 'required']) !!}
                                                    {!! Form::label('qn_2'.$question->id, ' ', ['class' => 'custom-control-label']) !!}
                                                </div>
                                            </td>
                                            <td class="text-nowrap" align="center">
                                                <div class="custom-control custom-radio">
                                                    {!! Form::radio('qn_'.$question->id, 3, false, ['id' => 'qn_3'.$question->id, 'class' => 'custom-control-input', 'required']) !!}
                                                    {!! Form::label('qn_3'.$question->id, ' ', ['class' => 'custom-control-label']) !!}
                                                </div>
                                            </td>
                                            <td class="text-nowrap" align="center">
                                                <div class="custom-control custom-radio">
                                                    {!! Form::radio('qn_'.$question->id, 4, false, ['id' => 'qn_4'.$question->id, 'class' => 'custom-control-input', 'required']) !!}
                                                    {!! Form::label('qn_4'.$question->id, ' ', ['class' => 'custom-control-label']) !!}
                                                </div>
                                            </td>
                                            <td class="text-nowrap" align="center">
                                                <div class="custom-control custom-radio">
                                                    {!! Form::radio('qn_'.$question->id, 5, false, ['id' => 'qn_5'.$question->id, 'class' => 'custom-control-input', 'required']) !!}
                                                    {!! Form::label('qn_5'.$question->id, ' ', ['class' => 'custom-control-label']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group p-15">
                            <label class="font-bold">Remarks*</label>
                            <textarea class="form-control auto-growth" rows="5" name="remarks" required></textarea>
                            <span class="help-block text-muted"><small>This field is required. Remarks remain anonymous.</small></span>
                        </div>

                        <div class="pull-right p-15">
                            <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                        </div>              
                    {!! Form::close() !!}
                </div>
            @endif
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
<!-- CUSTOM PAGE JS -->
<script src="{{ asset('js/pages/morss/take-survey-id.js') }}"></script>
<script>
    jQuery(document).ready(function() {

        // For sticky card
        $(".stickyside").stick_in_parent({
            offset_top: 100
        });

        autosize($('textarea.auto-growth'));

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