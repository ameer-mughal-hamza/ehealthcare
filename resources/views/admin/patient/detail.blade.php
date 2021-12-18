@extends('master-admin')
@section('title', $title)
@section('admin-css')
    <link href="{{ asset('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="wrapper">
        @include('admin/nav')
        <div id="page-wrapper" class="gray-bg">
            @include('admin.shared.breadcrumbs', ['title' => 'Doctors', 'page'=> 'Doctors'])
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Profile Detail</h5>
                            </div>
                            <div>
                                <div class="ibox-content profile-content">
                                    <h4><strong>{{ $patient->name }}</strong></h4>
                                    <p><i class="fa fa-envelope"></i> {{ $patient->email }} <span
                                            class="label {{ $patient->is_verified ? 'label-primary' : 'label-danger' }} ">{{ $patient->is_verified ? 'Verified' : 'Not Verified' }}</span>
                                    </p>
                                    <hr>
                                    <div class="row m-t-lg">
                                        <div class="col-md-4 text-center">
                                            <h3>Posts</h3>
                                            <h5><strong>169</strong></h5>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <h3>Role</h3>
                                            <h5>
                                                <strong>{{ $patient->role === 1 ? 'Patient' : '' }}</strong>
                                            </h5>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <h3>MRN</h3>
                                            <h5>
                                                <strong>{{ $patient->patient->mrn }}</strong>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Posts</h5>
                            </div>
                            <div class="ibox-content">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($patient->posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>{{ $post->description }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
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
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($patient->posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>{{ $post->description }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                </div>
            </div>
        </div>
    </div>
@endsection
