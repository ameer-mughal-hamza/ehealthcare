@extends('master-landing')

@section('title', "E Health Care - Login")

@section('nav')
    @include('landing-page/nav-no-scroll', ['cssClass' => 'navbar-scroll'])
@endsection

@section('content')
    <div class="middle-box text-center animated fadeInDown mt-5">
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        <h3>Forget Password</h3>
        <form class="m-t" role="form" method="POST" action="{{ url('/forget-password') }}">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Send forget reset email</button>
        </form>
    </div>
@endsection

@section('js')

@endsection
