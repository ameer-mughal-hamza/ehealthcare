@extends('master-admin')
@section('title', 'E Health Care - Dashboard')
@section('admin-css')
    <link href="{{ asset('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="wrapper">
        @include('admin/nav')
        <div id="page-wrapper" class="gray-bg">
            @include('admin.shared.breadcrumbs', ['title' => 'Doctors', 'page'=> 'Doctors'])
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row m-b-lg m-t-lg">
                    <div class="col-md-6">

                        <div class="profile-image">
                            <img src="{{ $doctor->doctor->picture_url }}"
                                 class="rounded-circle circle-border m-b-md" alt="profile">
                        </div>
                        <div class="profile-info">
                            <div class="">
                                <div>
                                    <h2 class="no-margins">
                                        Alex Smith
                                    </h2>
                                    <h6>
                                        @foreach($doctor->categories as $category)
                                            <span class="label label-primary">{{ $category->name }}</span>
                                        @endforeach
                                    </h6>
                                    <small>
                                        {{ $doctor->doctor->description }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <table class="table small m-b-xs">
                            <tbody>
                            <tr>
                                <td>
                                    <strong>Email</strong> {{ $doctor->email }}
                                </td>
                                <td>
                                    <strong>Role</strong> {{ $doctor->role === 2 ? 'Doctor' : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Date of Birth</strong> {{ $doctor->date_of_birth }}
                                </td>
                                <td>
                                    <strong>Email
                                        Verified</strong> <span
                                        class="label {{ $doctor->is_verified ? 'label-primary' : 'label-danger' }} ">{{ $doctor->is_verified ? 'Verified' : 'Not Verified' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Status</strong> <span
                                        class="label {{ $doctor->doctor->is_active ? 'label-primary' : 'label-danger' }} ">{{ $doctor->doctor->is_active ? 'Active' : 'Not Active' }}</span>
                                </td>
                                <td>
                                    <strong>Riziv Number</strong> {{ $doctor->doctor->riziv_number }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if($doctor->doctor->gender == 1)
                                        <strong>Gender</strong> Male
                                    @elseif($doctor->doctor->gender == 2)
                                        <strong>Gender</strong> Female
                                    @else
                                        <strong>Gender</strong> Other
                                    @endif
                                </td>
                                <td>
                                    <strong>Language</strong> {{ getLanguageValue($doctor->doctor->language)->value }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Mobile</strong> {{ $doctor->doctor->mobile }}
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Address</strong> {{ $doctor->address->street . ", " . $doctor->address->postal_code . " " . $doctor->address->muncipility . ", " . $doctor->address->city . ", " . $doctor->address->country }}
                                </td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <button class="btn btn-primary">Deactivate</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('admin-js')
    <script>
        $(document).ready(function () {
            $("#sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 48], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#1ab394',
                fillColor: "transparent"
            });
        });
    </script>
@endsection
