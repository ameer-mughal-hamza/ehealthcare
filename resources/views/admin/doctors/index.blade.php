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
                                        <th>Doctor ID</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>Specialization</th>
                                        <th>Contact No</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($doctors as $doctor)
                                        <tr>
                                            <td>{{ $doctor->doctor->riziv_number }}</td>
                                            <td>{{ $doctor->first_name . ' ' . $doctor->last_name }}</td>
                                            @if ($doctor->doctor->gender == 1)
                                                <td>Male</td>
                                            @elseif($doctor->doctor->gender == 2)
                                                <td>Female</td>
                                            @else
                                                <td>Other</td>
                                            @endif
                                            <td>{{ $doctor->email }}</td>
                                            <td>
                                                @foreach($doctor->categories as $category)

                                                    <span
                                                        class="label label-primary">{{ $category->name }}</span>
                                                @endforeach
                                                @if(count($doctor->categories) > 2)
                                                    <span
                                                        class="label label-primary">+{{ count($doctor->categories) - 2 }}</span>
                                                @endif
                                            </td>
                                            <td class="center">{{ $doctor->doctor->mobile }}</td>
                                            <td class="center">
                                                <a href="{{ url('/admin/doctors/detail/' . $doctor->id) }}"
                                                   class="btn btn-info btn-circle" type="button"><i
                                                        class="fa fa-eye"></i></a>
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
