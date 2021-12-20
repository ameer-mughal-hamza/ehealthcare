@extends('master-admin')
@section('title', 'E Health Care - Dashboard')
@section('admin-css')
    <link href="{{ asset('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="wrapper">
        @include('doctors/nav')
        <div id="page-wrapper" class="gray-bg">
            @include('shared.top-nav')
            @include('admin.shared.breadcrumbs', ['title' => 'Doctors', 'page'=> 'View'])
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-right">
                            {{--                            <form method="post" action="{{ route('doctor_add_new_patient') }}">--}}
                            {{--                                <input type="hidden" value="{{  }}">--}}
                            {{--                                <a href="{{ route('doctor_add_new_patient') }}" class="btn btn-primary">New Patient--}}
                            {{--                                    +</a>--}}
                            {{--                            </form>--}}
                            <a href="{{ route('doctor_add_new_patient') }}" class="btn btn-primary">New Patient +</a>
                        </div>
                        <div class="ibox ">
                            <div class="ibox-content">
                                <input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                                       placeholder="Search in table">
                                <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                    <thead>
                                    <tr>
                                        <th>MRN</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($prescriptions as $prescription)
                                        <tr>
                                            <td>{{ $prescription->patient->mrn }}</td>
                                            <td>{{ $prescription->patient->user->name }}</td>
                                            <td>{{ $prescription->patient->user->email }}</td>
                                            <td class="center">
                                                <a href="{{ url('doctor/patient/detail/'.$prescription->patient->user->id) }}"
                                                   class="btn btn-info btn-circle" type="button">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('prescribe_medicine_to_existing_patient', ["id" => $prescription->patient->user->id]) }}"
                                                   class="btn btn-warning btn-circle" type="button">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <ul class="pagination float-right"></ul>
                                        </td>
                                    </tr>
                                    </tfoot>
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
