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
            @include('admin.shared.breadcrumbs', ['title' => 'Doctors', 'page'=> 'Doctors'])
            <div class="wrapper wrapper-content animated fadeInRight">
                <form>
                    <a href="{{ route('approve_doctor_account', ['id' => $request->doctor->riziv_number]) }}"
                       type="submit"
                       class="btn btn-primary block full-width m-b">Approve</a>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>First Name</label>
                                <input name="first_name" value="{{ $request->first_name }}"
                                       type="text" disabled class="form-control" placeholder="First name" required>
                            </div>
                            <div class="col-md-4">
                                <label>Last Name</label>
                                <input name="last_name" value="{{ $request->last_name }}"
                                       type="text" disabled class="form-control" placeholder="Last name" required>
                            </div>
                            <div class="col-md-4">
                                <label>Email Verification</label>
                                <input name="last_name"
                                       value="{{ $request->is_verified ? "Email Verified" : "Email Verification Pending" }}"
                                       type="text" disabled class="form-control" placeholder="Last name" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" disabled value="{{ $request->email }}"
                               type="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Mobile</label>
                                <input value="{{ $request->doctor->mobile }}" disabled class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Gender</label>
                                @if ($request->doctor->gender === 1)
                                    <input value="Male" disabled class="form-control" required>
                                @elseif($request->doctor->gender === 2)
                                    <input value="Female" disabled class="form-control" required>
                                @else
                                    <input value="Other" disabled class="form-control" required>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label>Language</label>
                                <input value="{{ getLanguageValue($request->doctor->language)->value }}"
                                       disabled class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Categories</label>
                                <input value="{{ $request->categories[0]->name }}" disabled class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Age</label>
                                <input value="{{ $request->date_of_birth }}" class="form-control" disabled>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <input name="street" value="{{ $address }}" type="text" disabled
                               class="form-control" placeholder="Street" required>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea disabled name="description"
                                  placeholder="Enter description here"
                                  id="description"
                                  cols="30"
                                  rows="10"
                                  class="form-control">{{ $request->doctor->description }}</textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
