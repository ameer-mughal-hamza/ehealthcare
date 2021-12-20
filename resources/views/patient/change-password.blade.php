@extends('master-patient')
@section('title', 'E Health Care - Dashboard')

@section('content')
    <div id="wrapper">
        @include('patient/nav')
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if($errors)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Change Password</h5>
                            </div>
                            <div class="ibox-content">
                                <form action="{{ route('patient_update_password') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label">Old Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="old_password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label">New Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label">Confirm Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password_confirmation" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group row">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button type="submit" class="btn btn-white btn-sm">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary btn-sm">
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

@section('js')
@endsection
