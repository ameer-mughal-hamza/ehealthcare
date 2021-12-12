@extends('master-landing')

@section('title', "E Health Care - Contact Us")

@section('landing-css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('nav')
    @include('landing-page.nav-no-scroll', ['cssClass' => 'navbar-scroll'])
@endsection

@section('content')
<div class="container" style="margin-top: 75px;">
    <div id="app" class="row">
        <post-detail-component></post-detail-component>
    </div>
</div>
@include('landing-page.footer')
@endsection

@section('landing-js')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@endsection
