@extends('layouts.home.app')

@section('content')
<!-- <div class="row page-titles">
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
    <div class="col-md-3">
        <div class="card border-info">
            <div class="card-header bg-info text-white">
                Applications
                <div class="card-actions">
                    <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                    <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                    <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                </div>
            </div>
            <div class="card-body p-0 collapse show" style="">
                <ul class="feeds">
                    <a href="#">
                        <li><div class="bg-dark"><i class="fa fa-bell-o"></i></div> Applicant-Hiring System</li>
                    </a>
                    <a href="{{ url('/morss') }}">
                        <li><div class="bg-dark"><i class="fa fa-bell-o"></i></div> Morale Survey System</li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="container">

            @if($message = Session::get('success'))
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                  <strong>Success!</strong> {{ $message }}
                </div>
            @endif

            {!! Session::forget('success') !!}

            <br />
            <a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
            <a href="{{ URL::to('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
            <a href="{{ URL::to('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>
            {!! link_to_route('export.excel', 
                  'Export to Excel', null, 
                  ['class' => 'btn btn-info']) 
            !!}
            
            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="import_file" />
                <button class="btn btn-primary">Import File</button>
            </form>

        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    jQuery(document).ready(function() {
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