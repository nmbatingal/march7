@extends('layouts.app')

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
        <h4 class="text-themecolor">Profile</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
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
    <div class="col-lg-2 col-xlg-2 col-md-4">
        <div class="card stickyside">
            <div class="card-body">
                <ul class="list-style-none">
                    <li class="box-label"><a href="javascript:void(0)">All Contacts <span>123</span></a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)">Work <span>103</span></a></li>
                    <li><a href="javascript:void(0)">Family <span>19</span></a></li>
                    <li><a href="javascript:void(0)">Friends <span>623</span></a></li>
                    <li><a href="javascript:void(0)">Private <span>53</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-10 col-xlg-10 col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Table</h4>
                <h6 class="card-subtitle">Data table example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive m-t--50">
                    <table id="myTable" class="table table-hover table-striped no-wrap">
                        <colgroup>
                            <col width="5px">
                            <col>
                            <col>
                            <col>
                            <col width="5px">
                            <col>
                            <col width="5px">
                        </colgroup>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>
                                    <a href="app-contact-detail.html">
                                        <img src="{{ asset('assets/images/users/1.jpg') }}" alt="user" height="40" width="40" class="img-circle" />&nbsp;&nbsp; Genelia Deshmukh
                                    </a>
                                </td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                                <td>27</td>
                                <td>2011/01/25</td>
                                <td>$112,000</td>
                            </tr>
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
            }],
        select: {
            style: 'multi'
        },
        order: [[1, 'asc']]
    });
</script>   
@endsection

