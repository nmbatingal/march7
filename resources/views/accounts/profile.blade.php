@extends('layouts.home.app')

@section('styles')
<!-- page css -->
<link href="{{ asset('dist/css/pages/floating-label.css') }}" rel="stylesheet">
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
        <div class="card">
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
                    <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                        <span class="hidden-sm-up"><i class="ti-email"></i></span> 
                        <span class="hidden-xs-down">Settings</span>
                    </a> 
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="profile" role="tabpanel">
                    <div class="card-body">
                        <form class="form-material row">
                            <div class="form-group col-md-4">
                                <label class="col-md-12" for="firstname">First Name</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control form-control-line" name="firstname" value="{{ $profile->firstname }}" required>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="col-md-12" for="middlename">Middle Name</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control form-control-line" name="middlename" value="{{ $profile->middlename }}">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="col-md-12" for="lastname">Last Name</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control form-control-line" name="lastname" value="{{ $profile->lastname }}" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-12" for="sex">Sex</label>
                                <div class="col-md-12">
                                    <div class="custom-control custom-radio">
                                        {{ Form::radio('sex', 0, $profile->sex == 0 ? true : false, ['id' => 'sexMale', 'class' => 'custom-control-input']) }}
                                        <label class="custom-control-label" for="sexMale">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        {{ Form::radio('sex', 0, $profile->sex == 1 ? true : false, ['id' => 'sexFemale', 'class' => 'custom-control-input']) }}
                                        <label class="custom-control-label" for="sexFemale">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-12" for="birthdate">Birthday</label>
                                <div class="col-md-12">
                                    <input class="form-control" type="date" value="{{ date('Y-m-d', strtotime( $profile->birthday )) }}" id="example-date-input">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12" for="address">Address</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control form-control-line" name="address" value="{{ $profile->address }}" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" class="form-control form-control-line" name="email" value="{{ $profile->email }}" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-12" for="mobile_number">Phone No</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control form-control-line" name="mobile_number" placeholder="ex. 123 456 7890" value="{{ $profile->mobile_number }}">
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <div class="col-sm-12">
                                    <button class="btn btn-success">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="settings" role="tabpanel">
                    <div class="card-body">
                        <form class="floating-labels m-t-20">
                            <div class="form-group m-b-40">
                                <input type="text" class="form-control" value="{{ $profile->username }}">
                                <span class="bar"></span>
                                <label for="input1">Username</label>
                            </div>
                            <div class="form-group m-b-40">
                                <input type="password" class="form-control">
                                <span class="bar"></span>
                                <label for="input1">Password</label>
                            </div>
                            <div class="form-group m-b-40">
                                <input type="password" class="form-control">
                                <span class="bar"></span>
                                <label for="input1">Confirm password</label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-danger">Update Account</button>
                                </div>
                            </div>
                        </form>
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
@endsection

