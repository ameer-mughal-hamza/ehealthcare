@extends('master-patient')
@section('title', 'E Health Care - Dashboard')

@section('content')
    <div id="wrapper">
        @if($role === 3)
            @include('patient/nav')
        @elseif($role === 2)
            @include('doctors/nav')
        @else
            @include('admin/nav')
        @endif
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li style="padding: 20px">
                            <span class="m-r-sm text-muted welcome-message">Welcome to E Health Cate</span>
                        </li>
                        <li>
                            <a href="{{ url('logout') }}">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-8">
                    <h2>Prescription</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            Patients
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Prescription</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-4">
                    <div class="title-action">
                        <a href="{{ route('print_invoice', ['id' => $prescription->id]) }}" target="_blank"
                           class="btn btn-primary">
                            <i class="fa fa-print"></i>
                            Print Invoice
                        </a>
                    </div>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>Doctor Details:</h5>
                                    <address><strong>{{ $doctor->name }}</strong>
                                        <br>
                                        <p>{!! $address !!}</p>
                                        <abbr title="Phone">P:</abbr> {{ $mobile }}
                                    </address>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <span>Patient Details:</span>
                                    <address>
                                        <strong>{{ $patient->name }}</strong><br>
                                    </address>
                                    <p>
                                        <span><strong>Date: </strong>{{ $date }}</span><br/>
                                    </p>
                                </div>
                            </div>

                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>
                                    <tr>
                                        <th>Medicine Name</th>
                                        <th>Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($medicine as $med)
                                        <tr>
                                            <td>
                                                <div>
                                                    <h1>{{ $med->name }}</h1>
                                                </div>
                                                <p>{{ $med->description ?? ''  }}</p>
                                            </td>
                                            <td>{{ $med->quantity }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            @if ($prescription->remarks)
                                <div class="well m-t"><strong>Comments</strong>
                                    <p>{{ $prescription->remarks }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
