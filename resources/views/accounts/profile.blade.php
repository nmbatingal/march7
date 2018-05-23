@extends('layouts.home.app')

@section('styles')
<!-- page css -->
<link href="{{ asset('dist/css/pages/floating-label.css') }}" rel="stylesheet">
<!-- Cropper CSS -->
<link href="{{ asset('assets/node_modules/cropper/cropper.min.css') }}" rel="stylesheet">
<style type="text/css">
    .hidden {
        display: none;
    }

    .img-container {
      /* This is important */
      width: 100%;
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
                <center class="m-t-30"> 
                    <img src="{{ !empty($profile->_img) ? asset($profile->_img) : asset('img/users/user-icon.png') }}" class="img-circle" width="150" />
                    <p><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">Upload image</a></p>
                    <h4 class="card-title m-t-10">{{ $profile->fullNameFirst }}</h4>
                    <h6 class="card-subtitle">{{ $profile->position }}, {{ $profile->office['acronym'] }}</h6>
                </center>

                <!-- sample modal content -->
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Upload Image</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="hidden">
                                    {!! Form::open([ 'id' => 'form_image_upload', 'url' => url( '/accounts/profile/'.$profile->id.'/upload/image' ), 'method' => 'POST', 'files' => true ]) !!}
                                        <input id="user_id" type="hidden" name="user_id" value="{{ $profile->id }}"/>
                                    {!! Form::close() !!}
                                </div>

                                <div class="row">
                                    <!-- .Your image -->
                                    <div class="col-md-12">
                                        <div class="img-container">
                                            <img id="image" src="{{ !empty($profile->_img) ? asset($profile->_img) : asset('img/users/user-icon.png') }}" alt="Picture">
                                        </div>
                                    </div>
                                    <!-- /.Your image -->
                                </div>

                                <div class="row">
                                    <div class="col-md-9 docs-buttons">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="reset" title="Reset"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;reset&quot;)"> <span class="fa fa-refresh"></span> </span>
                                            </button>
                                            <label class="btn btn-secondary btn-outline btn-upload" for="inputImage" title="Upload image file">
                                                <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs"> <span class="fa fa-upload"></span> </span>
                                            </label>
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="destroy" title="Destroy"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;destroy&quot;)"> <span class="fa fa-power-off"></span> </span>
                                            </button>
                                        </div>
                                        <div class="btn-group btn-group-crop">
                                            <button type="button" class="btn btn-danger" data-method="getCroppedCanvas"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)"> Get Cropped Canvas </span> </button>
                                            <button type="button" class="btn btn-danger" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 160, &quot;height&quot;: 90 }"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 160, height: 90 })"> 160&times;90 </span> </button>
                                            <button type="button" class="btn btn-danger" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 320, &quot;height&quot;: 180 }"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 320, height: 180 })"> 320&times;180 </span> </button>
                                        </div>
                                        <!-- Show the cropped image in modal -->
                                        <div class="modal docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="getCroppedCanvasTitle">Cropped</h4>
                                                    </div>
                                                    <div class="modal-body"></div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal -->
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="getData" data-option data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getData&quot;)"> Get Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="setData" data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setData&quot;, data)"> Set Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="getContainerData" data-option data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getContainerData&quot;)"> Get Container Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="getImageData" data-option data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getImageData&quot;)"> Get Image Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="getCanvasData" data-option data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCanvasData&quot;)"> Get Canvas Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="setCanvasData" data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setCanvasData&quot;, data)"> Set Canvas Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="getCropBoxData" data-option data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCropBoxData&quot;)"> Get Crop Box Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="setCropBoxData" data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setCropBoxData&quot;, data)"> Set Crop Box Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="moveTo" data-option="0"> <span class="docs-tooltip" data-toggle="tooltip" title="cropper.moveTo(0)"> 0,0 </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="zoomTo" data-option="1"> <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoomTo(1)"> 100% </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="rotateTo" data-option="180"> <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotateTo(180)"> 180° </span> </button>
                                        <input type="text" class="form-control" id="putData" placeholder="Get data to here or set data with this value">
                                    </div>
                                    <!-- /.btn groups -->
                                    <div class="col-md-3 docs-toggles">
                                        <!-- .btn groups -->
                                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                                            <label class="btn btn-secondary btn-outline active">
                                                <input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio" value="1.7777777777777777">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 16 / 9"> 16:9 </span> </label>
                                            <label class="btn btn-secondary btn-outline">
                                                <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.3333333333333333">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 4 / 3"> 4:3 </span> </label>
                                            <label class="btn btn-secondary btn-outline">
                                                <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 1 / 1"> 1:1 </span> </label>
                                            <label class="btn btn-secondary btn-outline">
                                                <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="0.6666666666666666">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 2 / 3"> 2:3 </span> </label>
                                            <label class="btn btn-secondary btn-outline">
                                                <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: NaN"> Free </span> </label>
                                        </div>
                                        <!-- /.btn groups -->
                                        <!-- .btn groups -->
                                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                                            <label class="btn btn-secondary btn-outline active">
                                                <input type="radio" class="sr-only" id="viewMode0" name="viewMode" value="0" checked>
                                                <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 0"> VM0 </span> </label>
                                            <label class="btn btn-secondary btn-outline">
                                                <input type="radio" info="sr-only" id="viewMode1" name="viewMode" value="1">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 1"> VM1 </span> </label>
                                            <label class="btn btn-secondary btn-outline">
                                                <input type="radio" class="sr-only" id="viewMode2" name="viewMode" value="2">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 2"> VM2 </span> </label>
                                            <label class="btn btn-secondary  btn-outline">
                                                <input type="radio" class="sr-only" id="viewMode3" name="viewMode" value="3">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 3"> VM3 </span> </label>
                                        </div>
                                        <!-- /.btn groups -->
                                        <!-- .btn groups -->
                                        <div class="dropdown dropup docs-options">
                                            <button type="button" class="btn btn-success btn-block dropdown-toggle" id="toggleOptions" data-toggle="dropdown" aria-expanded="true"> Toggle Options <span class="caret"></span> </button>
                                            <ul class="dropdown-menu" aria-labelledby="toggleOptions" role="menu">
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="responsive" checked> responsive </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="restore" checked> restore </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="checkCrossOrigin" checked> checkCrossOrigin </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="checkOrientation" checked> checkOrientation </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="modal" checked> modal </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="guides" checked> guides </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="center" checked> center </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="highlight" checked> highlight </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="background" checked> background </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="autoCrop" checked> autoCrop </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="movable" checked> movable </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="rotatable" checked> rotatable </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="scalable" checked> scalable </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="zoomable" checked> zoomable </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="zoomOnTouch" checked> zoomOnTouch </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="zoomOnWheel" checked> zoomOnWheel </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="cropBoxMovable" checked> cropBoxMovable </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="cropBoxResizable" checked> cropBoxResizable </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="toggleDragModeOnDblclick" checked> toggleDragModeOnDblclick </label>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.dropdown -->
                                    </div>
                                    <!-- /.btn groups -->
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

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
<!-- Image cropper JavaScript -->
<script src="{{ asset('assets/node_modules/cropper/cropper.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/cropper/cropper-init.js') }}"></script>
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

