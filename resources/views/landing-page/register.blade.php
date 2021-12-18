@extends('master-landing')

@section('title', "E Health Care - Login")

@section('content')
@section('nav')
    @include('landing-page/nav-no-scroll', ['cssClass' => 'navbar-scroll'])
@endsection
<div class="middle-box text-center animated fadeInDown mt-5">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>Register to E Health Care</h1>
    <form method="post" class="m-t" role="form" action="{{ url('/register') }}">
        @csrf
        <div class="form-group">
            <input
                name="first_name"
                type="text"
                value="{{ old('first_name') }}"
                class="form-control"
                placeholder="First name" required>
        </div>
        <div class="form-group">
            <input
                name="last_name"
                type="text"
                value="{{ old('last_name') }}"
                class="form-control"
                placeholder="Last name" required>
        </div>
        <div class="form-group">
            <input
                name="email"
                type="email"
                value="{{ old('email') }}"
                class="form-control"
                placeholder="Username" required>
        </div>
        <div class="form-group">
            <input
                name="date_of_birth"
                type="date"
                max="{{ now()->toDateString('Y-m-d') }}"
                value="{{ old('date_of_birth') }}"
                class="form-control"
                placeholder="Username" required>
        </div>
        <div class="form-group">
            <input
                name="password"
                type="password"
                class="form-control"
                placeholder="Password" required>
        </div>
        <div class="form-group">
            <input
                name="password_confirmation"
                type="password"
                class="form-control"
                placeholder="Confirm Password" required>
        </div>
        <button type="submit" class="btn btn-primary block full-width m-b">Register</button>
        <a href="{{ url('auth/google') }}" class="btn btn-outline-primary block full-width m-b"><i
                class="fa fa-google"></i> Google
        </a>
        <a href="{{ url('auth/facebook') }}" class="btn btn-outline-primary block full-width m-b"><i
                class="fa fa-facebook-official"></i> Facebook
        </a>
        <a href="{{ url('/login') }}"><small>Already have an account?</small></a>
    </form>
</div>
@include('landing-page/footer')
@endsection

@section('js')

@endsection
