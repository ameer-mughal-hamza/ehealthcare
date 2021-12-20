@extends('master-patient')
@section('title', 'E Health Care - Dashboard')

@section('content')
    <div id="wrapper">
        @include('patient/nav')
        <div id="page-wrapper" class="gray-bg dashbard-1">
            @include('shared.top-nav')
            <div class="row mt-5">
                <div class="col-lg-2">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Prescriptions</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ getPatientTotalPrescriptions() }}</h1>
                            <small>Total</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Posts</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ getTotalPosts() }}</h1>
                            <small>Total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
