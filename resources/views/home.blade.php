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