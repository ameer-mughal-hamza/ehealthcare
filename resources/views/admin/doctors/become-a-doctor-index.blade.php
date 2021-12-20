@extends('master-admin')
@section('title', 'E Health Care - Dashboard')
@section('admin-css')
    <link href="{{ asset('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="wrapper">
        @include('admin/nav')
        <div id="page-wrapper" class="gray-bg">
            @include('shared.top-nav')
            @include('admin.shared.breadcrumbs', ['title' => 'Doctors', 'page'=> 'View'])
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                                       placeholder="Search in table">
                                <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                    <thead>
                                    <tr>
                                        <th>Riziv No.</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Age</th>
                                        <th>Contact No</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($requests as $request)
                                        <tr class="gradeA">
                                            <td>{{ $request->doctor->riziv_number }}</td>
                                            <td>{{ $request->first_name }}</td>
                                            <td>{{ $request->last_name }}</td>
                                            <td>{{ $request->email }}</td>
                                            <td>{{ $request->date_of_birth }}</td>
                                            <td>{{ $request->doctor->mobile }}</td>
                                            <td class="center">
                                                <a href="{{ URL("/admin/become-a-doctor/requests/view/" . $request->riziv_number) }}"
                                                   class="btn btn-info btn-circle"
                                                   type="button">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <button class="btn btn-warning btn-circle" type="button"><i
                                                        class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btn-circle" type="button"><i
                                                        class="fa fa-trash"></i></button>
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
