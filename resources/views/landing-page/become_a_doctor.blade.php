@extends('master-landing')

@section('title', "E Health Care - Contact Us")

@section('landing-css')
    <style>
        .middle-box {
            max-width: 800px;
            z-index: 100;
            margin: 0 auto;
            padding-top: 40px;
        }
    </style>
@endsection

@section('nav')
    @include('landing-page/nav-no-scroll', ['cssClass' => 'navbar-scroll'])
@endsection

@section('content')
    <div class="middle-box text-center animated fadeInDown mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('doctor_account_created') && Session::has('info'))
            <div class="alert alert-success alert-dismissible fade show">
                <h4 class="alert-heading">Congratulations!</h4>
                <p>An email is already sent to your email: {{ Session::get('verify_account_email') }}.</p>
                <p class="mb-0">Please verify the email.</p>
                <hr>
                <p>You will be notified when your account is being verified.</p>
                <a href="{{ url('/home') }}">Go to home</a>
            </div>
        @endif
        <h3>Become a Doctor</h3>
        <form method="post" class="m-t" role="form" action="{{ route('front_save_doctor') }}"
              enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input name="first_name" value="{{ old('first_name') }}"
                               type="text" class="form-control" placeholder="First name" required>
                    </div>
                    <div class="col-md-6">
                        <input name="last_name" value="{{ old('first_name') }}"
                               type="text" class="form-control" placeholder="Last name" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input name="email" value="{{ old('email') }}"
                       type="email" class="form-control" placeholder="Email" required>
            </div>


            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input name="password"
                               type="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="col-md-6">
                        <input name="password_confirmation"
                               type="password" class="form-control" placeholder="Confirm Password" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <input name="mobile" value="{{ old('mobile') }}"
                               type="text" class="form-control" placeholder="Mobile" required>
                    </div>
                    <div class="col-md-4">
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Gender</option>
                            <option value="1" {{ old('gender') == "1" ? 'selected' : '' }}>Male</option>
                            <option value="2" {{ old('gender') == "2" ? 'selected' : ''}}>Female</option>
                            <option value="3" {{ old('gender') == "3" ? 'selected' : ''}}>Other</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="language" id="language" class="form-control">
                            <option value="">Select Language</option>
                            @foreach($languages as $language)
                                @if (old('language') == $language->id)
                                    <option value="{{ $language->id }}" selected>{{ $language->value }}</option>
                                @else
                                    <option value="{{ $language->id }}">{{ $language->value }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <select name="categories[]" id="category" multiple class="form-control">
                    <option value="">Select Categories</option>
                    @foreach($categories as $category)
                        @if (old('category') == $category)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <input name="street" value="{{ old('street') }}" type="text"
                       class="form-control" placeholder="Street" required>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <select name="postal_code" id="postal_code" class="form-control">
                            <option value="">Select Postal Code</option>
                            @foreach($municipalities as $municipality)
                                @if (old('postal_code') == $municipality->list_zip . ', ' . $municipality->list_city)
                                    <option value="{{ $municipality->list_zip . ', ' . $municipality->list_city }}"
                                            selected>{{ $municipality->list_zip . ', ' . $municipality->list_city }}</option>
                                @else
                                    <option
                                        value="{{ $municipality->list_zip . ', ' . $municipality->list_city }}">{{ $municipality->list_zip . ', ' . $municipality->list_city }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="city" id="city" class="form-control">
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                                @if (old('city') == $city->city)
                                    <option value="{{ $city->city }}" selected>{{ $city->city }}</option>
                                @else
                                    <option value="{{ $city->city }}">{{ $city->city }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input name="date_of_birth" value="{{ old('date_of_birth') }}" type="date"
                               max="{{ now()->toDateString('Y-m-d') }}"
                               class="form-control" placeholder="Date of Birth" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="custom-file">
                        <input id="image" name="file" type="file" class="custom-file-input">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <select name="country" id="country" class="form-control" disabled>
                    <option value="Belgium">Belgium</option>
                </select>
            </div>
            <div class="form-group">
                <textarea name="description" placeholder="Enter description here" id="description" cols="30" rows="10"
                          class="form-control">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Submit</button>
        </form>
    </div>
@endsection

@section('js')

@endsection
