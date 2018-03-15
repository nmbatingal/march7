@extends('layouts.home.app')

@section('styles')
<!-- page css -->
<link href="{{ asset('dist/css/pages/floating-label.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Roles</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/accounts') }}">Accounts</a></li>
                <li class="breadcrumb-item active">Roles</li>
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
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Roles<div class="pull-right"><a href="{{ url('/accounts/permissions') }}" class="btn btn-xs btn-info waves-effect waves-light text-white">Create Permission</a></div></h4>

                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-rounded"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                            <i class="fa fa-exclamation-triangle text-danger"></i> {{ $error }}
                        </div>
                    @endforeach
                @endif

                {!! Form::open(['url' => route('roles.store'), 'class' => 'floating-labels m-t-30']) !!}
                    @if($permissions->isEmpty())
                        <div class="alert alert-danger alert-rounded"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                            <i class="fa fa-exclamation-triangle text-danger"></i> Create permissions first before proceeding.
                        </div>
                    @else
                        <div class="form-group m-b-40">
                            {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                            <span class="bar"></span>
                            {{ Form::label('name', 'Role Name', ['class' => 'form-label']) }}
                        </div>

                        <h6 class="card-subtitle"> Assign Permissions </h6>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                @foreach ($permissions as $permission)
                                    <div class="custom-control custom-checkbox p-l-10">
                                        {{ Form::checkbox( 'permissions[]', $permission->id, false, [ 'id' => $permission->name, 'class' => 'custom-control-input' ]) }}
                                        {{ Form::label( $permission->name, ucfirst($permission->name), ['class' => 'custom-control-label p-l-30']) }}
                                        <br>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pull-right">
                            {{ Form::button('Submit', ['class' => 'btn btn-success waves-effect waves-light', 'type' => 'submit']) }}
                        </div>
                    @endif
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <colgroup>
                            <col>
                            <col>
                            <col>
                            <col width="5%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Roles</th>
                                <th>Permission</th>
                                <th>Users</th>
                                <th class="text-nowrap text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $roles as $role )
                                <tr>
                                    <td>
                                        <a href="javascript:void(0)">
                                            {{ $role->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @foreach ( $role->permissions()->pluck('name') as $permission)
                                            {{ $permission }} <br>
                                        @endforeach
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
                    {{ $roles->links() }}
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
