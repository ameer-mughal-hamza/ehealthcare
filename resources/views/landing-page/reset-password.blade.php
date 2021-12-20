@extends('master-landing')

@section('title', "E Health Care - Login")

@section('nav')
    @include('landing-page/nav-no-scroll', ['cssClass' => 'navbar-scroll'])
@endsection

@section('content')
    <div class="middle-box animated fadeInDown mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h3 class="text-center">Reset Password</h3>
        <form class="m-t" role="form" method="POST" action="{{ url('/reset-password') }}">
            @csrf
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label for="">New Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"
                       required>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Submit</button>
        </form>
    </div>
@endsection

@section('js')

@endsection
