@extends('master-admin')
@section('title', 'E Health Care - Dashboard')
@section('admin-css')
    <link href="{{ asset('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="wrapper">
        @include('patient/nav')
        <div id="page-wrapper" class="gray-bg">
            @include('shared.top-nav')
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Prescriptions</h5>
                            </div>
                            <div class="ibox-content">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($prescriptions as $prescription)
                                        <tr>
                                            <td>{{ $prescription->id }}</td>
                                            <td>{{ Str::limit($prescription->medicine, 55)}}</td>
                                            <td>
                                                <a href="{{ route('show_patient_prescription', ["id" => $prescription->id]) }}"
                                                   class="btn btn-info btn-circle" type="button">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                {{--                                                <a href="{{ route('show_patient_prescription', ['id' => $prescription->id]) }}"--}}
                                                {{--                                                   class="btn btn-success btn-circle" type="button">--}}
                                                {{--                                                    <i class="fa fa-eye"></i>--}}
                                                {{--                                                </a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot></tfoot>
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
