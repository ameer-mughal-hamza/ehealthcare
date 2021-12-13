@extends('master-landing')

@section('title', "E Health Care - Login")

@section('nav')
    @include('landing-page/nav-no-scroll', ['cssClass' => 'navbar-scroll'])
@endsection

@section('content')
    <div class="middle-box text-center animated fadeInDown mt-5">
        @if(Session::has('verify_account'))
            <div class="alert alert-info alert-dismissible fade show">
                <h4 class="alert-heading">!! Alert !!</h4>
                <p>An email is already sent to your email: {{ Session::get('verify_account_email') }}.</p>
                <hr>
                <p class="mb-0">Please verify the email and login again.</p>
                <a href="{{ url('/home') }}">Go to home</a>
            </div>
        @endif
        @if(Session::has('patient_dashboard_restrict'))
            <div class="alert alert-danger alert-dismissible fade show">
                <h4 class="alert-heading">!! Alert !!</h4>
                <p>{{ Session::get('patient_dashboard_restrict') }}.</p>
                <a href="{{ url('/home') }}">Go to home</a>
            </div>
        @endif
        <h1>Welcome to E Health Care</h1>
        <h3>Login</h3>
        <form method="post" class="m-t" role="form" action="{{ url('/login') }}">
            @csrf
            <div class="form-group">
                <input name="email" type="email" value="{{ old('email') }}" class="form-control" placeholder="Username"
                       required>
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            <a href="{{ url('auth/google') }}" class="btn btn-outline-primary block full-width m-b"><i
                    class="fa fa-google"></i> Google
            </a>
            <a href="{{ url('auth/facebook') }}" class="btn btn-outline-primary block full-width m-b"><i
                    class="fa fa-facebook-official"></i> Facebook
            </a>
            <a href="{{ url('/forget-password') }}"><small>Forgot password?</small></a>
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="{{ url('register') }}">Create an account</a>
        </form>
    </div>
    @include('landing-page/footer')
@endsection

@section('js')

@endsection
