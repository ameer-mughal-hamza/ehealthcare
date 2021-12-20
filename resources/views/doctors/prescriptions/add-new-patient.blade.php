@extends('master-admin')

@section('title', "E Health Care - Login")

@section('nav')
    @include('landing-page/nav-no-scroll', ['cssClass' => 'navbar-scroll'])
@endsection

@section('content')
    <div id="wrapper">
        @include('doctors/nav')
        <div id="page-wrapper" class="gray-bg">
            @include('shared.top-nav')
            @include('admin.shared.breadcrumbs', ['title' => 'Patients', 'page'=> 'Patients'])
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Add new Patient</h1>
                        <form method="post" action="{{ route('doctor_prescribe_medicine') }}" class="m-t" role="form" action="{{ url('/') }}">
                            @csrf
                            <div class="form-group">
                                <input name="mrn" type="text" value="{{ old('mrn') }}" class="form-control"
                                       placeholder="Username"
                                       required>
                            </div>
                            <div class="form-group">
                                <input name="last_name" type="text" placeholder="Last name"
                                       value="{{ old('last_name') }}" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary block full-width m-b">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
