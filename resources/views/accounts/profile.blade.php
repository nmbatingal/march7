@extends('layouts.home.app')

@section('styles')
<!-- page css -->
<link href="{{ asset('dist/css/pages/floating-label.css') }}" rel="stylesheet">
<style type="text/css">
    .hidden {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Profile</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/accounts') }}">Accounts</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card stickyside">
            <div class="card-body">
                <center class="m-t-30"> <img src="{{ asset('img/users/user-icon.png') }}" class="img-circle" width="150" />
                    <h4 class="card-title m-t-10">{{ $profile->firstname }} {{ $profile->middlename ? $profile->middlename[0].'.' : '' }} {{ $profile->lastname }}</h4>
                    <h6 class="card-subtitle">{{ $profile->position }}, {{ $profile->office['acronym'] }}</h6>
                </center>
            </div>
            <div>
                <hr> </div>
            <div class="card-body"> 
                <small class="text-muted">Email address </small>
                <h6>{{ $profile->email }}</h6> 
                <small class="text-muted p-t-30 db">Phone</small>
                <h6>{{ $profile->mobile_number ?: '-' }}</h6> 
                <small class="text-muted p-t-30 db">Address</small>
                <h6>{{ $profile->address ?: '-'}}</h6>
                <small class="text-muted p-t-30 db">Birthday</small>
                <h6>{{ date("F d, Y", strtotime( $profile->birthday )) }}</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item"> 
                            <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">
                                <span class="hidden-sm-up"><i class="ti-user"></i></span> 
                                <span class="hidden-xs-down">Profile</span>
                            </a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" data-toggle="tab" href="#roles" role="tab">
                                <span class="hidden-sm-up"><i class="ti-email"></i></span> 
                                <span class="hidden-xs-down">User Settings</span>
                            </a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                                <span class="hidden-sm-up"><i class="ti-email"></i></span> 
                                <span class="hidden-xs-down">Login Settings</span>
                            </a> 
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- PROFILE TAB -->
                        <div class="tab-pane active" id="profile" role="tabpanel">
                            <div class="card-body">
                                {{ Form::model($profile, [ 'url' => url( '/accounts/profile/'.$profile->id ), 'method' => 'PUT', 'id' => 'form_profile', 'class' => 'form-control-line']) }}
                                    <div class="form-body">
                                        <h3 class="box-title">Personal Info</h3>
                                        <hr class="m-t-0">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label" for="firstname">First Name</label>
                                                <input type="text" class="form-control" name="firstname" value="{{ $profile->firstname }}" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label" for="middlename">Middle Name</label>
                                                <input type="text" class="form-control" name="middlename" value="{{ $profile->middlename }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label" for="lastname">Last Name</label>
                                                <input type="text" class="form-control " name="lastname" value="{{ $profile->lastname }}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="sex" class="form-control-label">Sex</label>
                                                <div class="form-control-checkboxes">
                                                    <div class="custom-control custom-radio">
                                                        {{ Form::radio('sex', 0, false, ['id' => 'sexMale', 'class' => 'custom-control-input', 'required']) }}
                                                        <label class="custom-control-label" for="sexMale">Male</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        {{ Form::radio('sex', 1, false, ['id' => 'sexFemale', 'class' => 'custom-control-input']) }}
                                                        <label class="custom-control-label" for="sexFemale">Female</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label" for="birthdate">Birthday</label>
                                                <input class="form-control" name="birthday" type="date" value="{{ date('Y-m-d', strtotime( $profile->birthday )) }}">
                                            </div>
                                        </div>
                                        <h3 class="box-title">Contact Info</h3>
                                        <hr class="m-t-0">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="form-control-label" for="address">Address</label>
                                                <input type="text" class="form-control " name="address" value="{{ $profile->address }}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="email" class="form-control-label">Email</label>
                                                <input type="email" class="form-control " name="email" value="{{ $profile->email }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label" for="mobile_number">Phone No</label>
                                                <input type="text" class="form-control " name="mobile_number" placeholder="ex. 123 456 7890" value="{{ $profile->mobile_number }}">
                                            </div>
                                        </div>
                                        <h3 class="box-title">Office Info</h3>
                                        <hr class="m-t-0">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label" for="position">Position</label>
                                                <input type="text" class="form-control " name="position" value="{{ $profile->position }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label" for="address">Unit / Division / Section</label>
                                                <select class="form-control" name="office" required>
                                                    @foreach ( $offices as $office )
                                                        <option value="{{ $office->id }}" {{ $profile->office_id == $office->id ? 'selected' : '' }}>{{ $office->office_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <div class="col-sm-12">
                                                    {!! Form::submit('Update Profile', ['class' => 'btn btn-success']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                        <!-- END PROFILE TAB -->
                        <!-- ROLES TAB -->
                        <div class="tab-pane" id="roles" role="tabpanel">
                            <div class="card-body">
                                {!! Form::model($profile, [ 'url' => url( '/accounts/profile/'.$profile->id.'/update-user-roles' ), 'method' => 'POST', 'id' => 'form_roles', 'class' => 'form-control-line']) !!}
                                    <div class="form-body">
                                        <h3 class="box-title">User Account Role</h3>
                                        <hr class="m-t-0">
                                        <div class="row m-l-15">
                                            <div class="form-group col-md-6">
                                                <div class="custom-control custom-checkbox">
                                                    {{ Form::checkbox('is_active', 1, $profile->_isActive == 1 ? true : false, ['id' => 'is_active', 'class' => 'custom-control-input'] ) }}
                                                    {{ Form::label('is_active', 'set account to active', ['class' => 'custom-control-label']) }}
                                                </div>
                                                {{ Form::checkbox('is_admin', 1, $profile->_isAdmin == 1 ? true : false, ['id' => 'is_admin', 'class' => 'hidden']) }}
                                            </div>
                                        </div>
                                        <div class="row m-l-15">
                                            <div class="form-group col-md-6">
                                                <label for="sex" class="form-control-label">Check to assign roles to a user account</label>
                                                @foreach ($roles as $role)
                                                    <div class="custom-control custom-checkbox">
                                                        {{ Form::checkbox('roles[]',  $role->id, $profile->roles, ['id' => $role->name, 'class' => 'custom-control-input'] ) }}
                                                        {{ Form::label($role->name, ucfirst($role->name), ['class' => 'custom-control-label']) }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <div class="col-sm-12">
                                                    {!! Form::submit('Update user roles', ['class' => 'btn btn-success']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <!-- END ROLES TAB -->
                        <!-- SETTINGS TAB -->
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-body">
                                {!! Form::model($profile, [ 'url' => url( '/accounts/profile/'.$profile->id.'/update-password' ), 'method' => 'POST', 'id' => 'form_settings', 'class' => 'form-control-line']) !!}
                                    <div class="form-body">
                                        <h3 class="box-title">Login Info</h3>
                                        <hr class="m-t-0">
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label" for="username">Username</label>
                                            <input type="text" class="form-control" name="username" value="{{ $profile->username }}" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label" for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label" for="confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control" name="confirm_password" required>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-danger">Update Account</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <!-- END SETTINGS TAB -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
@endsection

@section('scripts') 
<script src="{{ asset('dist/js/pages/jasny-bootstrap.js') }}"></script>
<script src="{{ asset('js/pages/accounts/profile.js') }}"></script>
<script>
    // This is for the sticky sidebar    
    $(".stickyside").stick_in_parent({
        offset_top: 100
    });
</script>
<script>
    $(document).ready(function() {
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

