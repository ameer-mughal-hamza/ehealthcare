@extends('master-landing')

@section('title', "E Health Care - Login")
@endsection

@section('content')
@section('nav')
    @include('landing-page/nav-no-scroll', ['cssClass' => 'navbar-scroll'])
@endsection
<div class="middle-box text-center animated fadeInDown mt-5">
    <div class="alert alert-success">
        Email sent!
    </div>
    <h3>Forget Password</h3>
    <form class="m-t" role="form" action="index.html">
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" required="">
        </div>
        <button type="submit" class="btn btn-primary block full-width m-b">Send forget reset email</button>
    </form>
</div>
@endsection

@section('js')

@endsection
