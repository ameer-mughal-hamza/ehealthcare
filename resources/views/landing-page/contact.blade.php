@extends('master-landing')

@section('title', "E Health Care - Contact Us")

@section('nav')
    @include('landing-page/nav-no-scroll', ['cssClass' => 'navbar-scroll'])
@endsection

@section('content')
<div class="middle-box text-center animated fadeInDown mt-5">
    <h3>Contact Us</h3>
    <form method="post" class="m-t" role="form" action="{{ url('home') }}">
        @csrf
        <div class="form-group">
            <input name="name" value="{{ old('name', Auth::check() ? auth()->user()->name : '') }}" type="text" class="form-control" placeholder="Name" required="">
        </div>
        <div class="form-group">
            <input name="email" value="{{ old('name', Auth::check() ? auth()->user()->email : '' ) }}" type="email" class="form-control" placeholder="Email" required="">
        </div>
        <div class="form-group">
            <textarea name="message" placeholder="Write your message here" class="form-control" id="message" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary block full-width m-b">Submit</button>
    </form>
</div>
@endsection

@section('js')

@endsection
