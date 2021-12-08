@extends('master-admin')
@section('title', 'E Health Care - Dashboard')
@section('admin-css')
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div id="wrapper">
        @include('admin/nav')
        <div id="page-wrapper" class="gray-bg">
            @include('admin.shared.breadcrumbs', ['title' => 'Doctors', 'page'=> 'Doctors'])
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>
                                    All form elements
                                    <small>With custom checbox and radion elements.</small>
                                </h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li>
                                            <a href="#" class="dropdown-item">Config option 1</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <form method="get">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-1 col-form-label">First Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"/>
                                            </div>
                                            <label class="col-sm-1 col-form-label">Last Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-1 col-form-label">Email</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"/>
                                            </div>
                                            <label class="col-sm-1 col-form-label">Mobile</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="inputGroupFile01" type="file" class="custom-file-input">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <div class="i-checks">
                                                <label> <input type="checkbox" /> Remember me </label>
                                            </div>
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
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".i-checks").iCheck({
                checkboxClass: "icheckbox_square-green",
                radioClass: "iradio_square-green",
            });

            bsCustomFileInput.init()
        });
    </script>
@endsection
