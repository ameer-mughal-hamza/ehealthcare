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
            @include('admin.shared.breadcrumbs', ['title' => 'Patients', 'page'=> 'Patients'])
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h3>
                                    Add Patient Record
                                </h3>
                            </div>
                            <div class="ibox-content">
                                <form method="get">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Patient ID</label>

                                        <div class="col-sm-3">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name</label>

                                        <div class="col-sm-3">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name</label>

                                        <div class="col-sm-3">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name</label>

                                        <div class="col-sm-3">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Gender<br></label>

                                        <div class="col-sm-10">
                                            <div>
                                                <label>
                                                    <input type="radio" checked="" value="option1" id="optionsRadios1"
                                                           name="optionsRadios">
                                                    Male
                                                </label>
                                                <label>
                                                    <input type="radio" value="option2" id="optionsRadios2"
                                                           name="optionsRadios">
                                                    Female
                                                </label>
                                                <label>
                                                    <input type="radio" value="option2" id="optionsRadios3"
                                                           name="optionsRadios">
                                                    Other
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Date of Birth</label>
                                        <div class="col-sm-2">
                                            <input type="date" class="form-control">
                                        </div>
                                        <div class="col-sm-1">
                                        </div>

                                        <label class="col-sm-1 col-form-label">Email</label>
                                        <div class="col-sm-3">
                                            <input type="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Password</label>

                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Address</label>

                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Address" class="form-control">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group row">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-white btn-sm" type="submit">
                                                Cancel
                                            </button>
                                            <button class="btn btn-primary btn-sm" type="submit">
                                                Save changes
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
