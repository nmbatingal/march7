@extends('layouts.home.app')

@section('styles')
<!-- page css -->
<link href="{{ asset('dist/css/pages/floating-label.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Permission</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/accounts') }}">Accounts</a></li>
                <li class="breadcrumb-item active">Permission</li>
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
<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Permission<div class="pull-right"><a href="{{ url('/accounts/roles') }}" class="btn btn-xs btn-info waves-effect waves-light text-white">Create Role</a></div></h4>
                {!! Form::open(['url' => route('permissions.store'), 'class' => 'floating-labels m-t-40']) !!}
                    <div class="form-group m-b-40">
                        {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                        <span class="bar"></span>
                        {{ Form::label('name', 'Permission', ['class' => 'form-label']) }}
                    </div>

                    <div class="pull-right">
                        {{ Form::button('Submit', ['class' => 'btn btn-success waves-effect waves-light', 'type' => 'submit']) }}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-md-8 col-sm-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <colgroup>
                            <col>
                            <col>
                            <col width="5%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Permission</th>
                                <th>Roles</th>
                                <th class="text-nowrap text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $permissions as $permission )
                                <tr>
                                    <td>
                                        <a href="javascript:void(0)">
                                            {{ $permission->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="label label-table label-success">Open</div>
                                    </td>
                                    <td class="text-nowrap" align="center">
                                        <a href="javascript:void(0)" class="p-r-5" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-info"></i> </a>
                                        <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-r-20">
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        var flash     = {!! json_encode(session('test')) !!};
        

        if ( flash )
        {   
            $(flash).each(function (i) {
                $.toast({
                    // heading: flash[0]['heading'],
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
