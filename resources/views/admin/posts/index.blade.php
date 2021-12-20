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
                @if(Session::has('not_found'))
                    <div class="alert alert-danger alert-dismissible fade show">
                            {{ Session::get('not_found') }}

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(Session::has('deleted_message'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ Session::get('deleted_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Message Table</h5>
                            </div>
                            <div class="ibox-content">
                                <input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                                       placeholder="Search patients">

                                <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    @foreach($posts as $post)
                                        <tr class="gradeA">
                                            <td class="center">{{ $post->id }}</td>
                                            <td class="center">{{ $post->user->name }}</td>
                                            <td class="center" title="{{ $post->description }}">{{ Str::limit($post->description, 55) }}</td>
                                            <td class="center">
                                                <a href="{{ route('view_message', $post->id) }}" class="btn btn-success btn-circle">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-warning btn-circle">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('delete_message', $post->id) }}" class="btn btn-danger btn-circle">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
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
