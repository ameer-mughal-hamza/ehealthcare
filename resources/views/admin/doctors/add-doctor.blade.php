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
            @include('admin.shared.breadcrumbs', ['title' => 'Doctor', 'page'=> 'Doctor'])
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h3>
                                    Add Doctor Record
                                </h3>
                                {{--                                <div class="ibox-tools">--}}
                                {{--                                    <a class="collapse-link">--}}
                                {{--                                        <i class="fa fa-chevron-up"></i>--}}
                                {{--                                    </a>--}}
                                {{--                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">--}}
                                {{--                                        <i class="fa fa-wrench"></i>--}}
                                {{--                                    </a>--}}
                                {{--                                    <ul class="dropdown-menu dropdown-user">--}}
                                {{--                                        <li>--}}
                                {{--                                            <a href="#" class="dropdown-item">Config option 1</a>--}}
                                {{--                                        </li>--}}
                                {{--                                        <li>--}}
                                {{--                                            <a href="#" class="dropdown-item">Config option 2</a>--}}
                                {{--                                        </li>--}}
                                {{--                                    </ul>--}}
                                {{--                                    <a class="close-link">--}}
                                {{--                                        <i class="fa fa-times"></i>--}}
                                {{--                                    </a>--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="ibox-content">
                                <form method="get">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="id">Doctor ID</label>
                                                <input id="id" placeholder="Doctor ID" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input id="name" placeholder="Enter Name" type="text"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select id="gender" name="gender" class="form-control m-b">
                                                    <option value="" selected disabled hidden>Choose here</option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                    <option>Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email"> Email</label>
                                                <input id="email" type="email" placeholder="Enter email"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dob">Date of Birth</label>
                                                <input id="dob" type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input id="address" type="email" placeholder="Enter Address"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="specialization">Specialization</label>
                                                {{--                                                <input id="specialization" class="form-control">--}}
                                                <select id="specialization" class="js-example-basic-multiple form-control" name="states[]" multiple="multiple" >
                                                    <option value="AI">Allergy and immunology</option>
                                                    <option value="AN">Anesthesiology</option>
                                                    <option value="DR">Dermatology</option>
                                                    <option value="DR">Diagnostic radiology</option>
                                                    <option value="EM">Emergency medicine</option>
                                                    <option value="FM">Family medicine</option>
                                                    <option value="NE">Neurology</option>
                                                    <option value="UR">Urology</option>
                                                    <option value="PA">Pathology</option>
                                                    <option value="OG">Obstetrics and gynecology</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contact">Contact No</label>
                                                <input id="contact" type="digits" pattern="[789][0-9]{9}"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" placeholder="Enter email" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="row text-right">
                                        <div class="col-sm-12">
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
