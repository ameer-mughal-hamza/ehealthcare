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
            @include('admin.shared.breadcrumbs', ['title' => 'Categories', 'page'=> 'Add'])
            <div class="wrapper wrapper-content animated fadeInRight">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h3>
                                    Add Category
                                </h3>
                            </div>
                            <div class="ibox-content">
                                <form method="post" action="{{ route('add_new_category') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4 col-sm-offset-2 ">
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
