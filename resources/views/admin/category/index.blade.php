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
            @include('admin.shared.breadcrumbs', ['title' => 'Categories', 'page'=> 'All'])
            <div class="wrapper wrapper-content animated fadeInRight">
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ Session::get('success') }}

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ Session::get('error') }}

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-right">
                            <a href="{{ url('admin/add/category') }}" class="btn btn-primary">Add</a>
                        </div>
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Category Table</h5>
                            </div>
                            <div class="ibox-content">
                                <input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                                       placeholder="Search patients">

                                <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr class="gradeA">
                                            <td class="center">{{ $category->id }}</td>
                                            <td class="center">{{ $category->name }}</td>
                                            <td class="center">{{ $category->slug }}</td>
                                            <td class="center">
                                                <a href="{{ url('admin/edit/' .$category->slug.'/category') }}"
                                                   class="btn btn-warning btn-circle" type="button">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('delete_category', $category->slug) }}"
                                                   class="btn btn-danger btn-circle"
                                                   type="button">
                                                    <i class="fa fa-trash"></i></a>
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
