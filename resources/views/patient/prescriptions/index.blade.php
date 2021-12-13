@extends('master-admin')
@section('title', 'E Health Care - Dashboard')
@section('admin-css')
    <link href="{{ asset('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="wrapper">
        @include('patient/nav')
        <div id="page-wrapper" class="gray-bg">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Patient(s) Table</h5>
                            </div>
                            <div class="ibox-content">
                                <input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                                       placeholder="Search patients">

                                <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                    <thead>
                                    <tr>
                                        <th>Patient ID</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th data-hide="phone,tablet">Age</th>
                                        <th data-hide="phone,tablet">Email</th>
                                        <th data-hide="phone,tablet">Contact</th>
                                        <th data-hide="phone,tablet">Address</th>
                                        <th data-hide="phone,tablet">Actions</th>

                                    </tr>
                                    </thead>
                                    <tr class="gradeA">

                                        <td> 1234567</td>
                                        <td>Patient 1</td>
                                        <td>Male</td>
                                        <td>30</td>
                                        <td class="center">test@test.com</td>
                                        <td class="center">0412345678</td>
                                        <td class="center">Nieuwelaan 149, 1040 Etterbeek</td>
                                        <td class="center">
                                            <button class="btn btn-info btn-circle" type="button"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-warning btn-circle" type="button"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger btn-circle" type="button"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('admin-js')
    <script src="{{ asset('js/plugins/footable/footable.all.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.footable').footable();
        });
    </script>
@endsection
