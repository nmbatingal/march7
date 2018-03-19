@extends('layouts.home.app')

@section('styles')
<!-- Page CSS -->
<link href="{{ asset('dist/css/pages/contact-app-page.css') }}" rel="stylesheet">
<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/css/dataTables.checkboxes.css" rel="stylesheet" />
<style>
    html body .m-t--50 {
        margin-top: -50px;
    }
</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Accounts</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Accounts</li>
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
    <div class="col-lg-2 col-xlg-2 col-md-4">
        <div class="card stickyside">
            <div class="card-body">
                <ul class="list-style-none">
                    <li class="box-label"><a href="javascript:void(0)">All <span>{{ count($users) }}</span></a></li>
                    <li class="divider"></li>
                    @foreach($offices as $office)
                        <li><a href="javascript:void(0)">{{ $office->acronym }} <span> {{ $office->staffs->count() }}</span></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-10 col-xlg-10 col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">User Accounts</h4>
                <h6 class="card-subtitle">List of user accounts</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive m-t--50">
                    <table id="myTable" class="table table-hover table-striped no-wrap">
                        <colgroup>
                            <col width="5%">
                            <col>
                            <col width="5%">
                            <col>
                            <col>
                            <col>
                            <col>
                            <col width="5%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Birthdate</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="{{ url( 'accounts/profile/'.$user->id )}}">
                                            <img src="{{ asset('img/users/user-icon.png') }}" alt="user" height="40" width="40" class="img-circle" />
                                            &nbsp;&nbsp; {{ $user->firstname }} {{ $user->middlename ? $user->middlename[0].'.' : '' }} {{ $user->lastname }}
                                        </a>
                                    </td>
                                    <td align="center">
                                        @if( $user->_isActive )
                                            <span class="badge badge-pill badge-success">active</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->position }}</td>
                                    <td>{{ $user->office['acronym'] }}</td>
                                    <td>{{ date("F d, Y", strtotime( $user->birthday )) }}</td>
                                    <td>
                                        @foreach ( $user->roles()->pluck('name') as $role )
                                            <span class="label label-pill label-info">{{ $role }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('form_reset_password').submit();" data-toggle="tooltip" data-original-title="reset password"> <i class="fa fa-undo text-inverse"></i> </a>

                                        {!! Form::open(['url' => url('/accounts/profile/'.$user->id.'/reset'), 'id' => 'form_reset_password', 'style' => 'display: none']) !!}
                                        {!! Form::close() !!}

                                        <a href="{{ url( 'accounts/profile/'.$user->id )}}" data-toggle="tooltip" data-original-title="update account"> <i class="fa fa-pencil text-info"></i> </a>
                                        <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="remove account"> <i class="fa fa-remove text-danger"></i> </a>
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
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
@endsection

@section('scripts')
<!-- This is data table -->
<script src="{{ asset('assets/node_modules/datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/js/dataTables.checkboxes.min.js"></script>
<script>
    // This is for the sticky sidebar    
    $(".stickyside").stick_in_parent({
        offset_top: 100
    });
    // Datatable
    var table = $('#myTable').DataTable({
       columnDefs: [
            {
                targets: 0,
                checkboxes: {
                    selectRow: true
                }
            },
            {
                orderable: false,
                targets: 7
            },
        ],
        select: {
            style: 'multi'
        },
        order: [[1, 'asc']]
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

