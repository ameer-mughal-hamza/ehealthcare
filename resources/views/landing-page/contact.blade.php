@extends('master-landing')

@section('title', "E Health Care - Contact Us")

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
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        <h3>Contact Us</h3>
        @if(auth()->check())
            <form method="post" class="m-t" role="form" action="{{ url('/contact') }}">
                @else
                    <form method="post" class="m-t" role="form" action="{{ url('/contact') }}">
                        @endif
                        @csrf
                        <div class="form-group">
                            <input name="name" value="{{ old('name', Auth::check() ? auth()->user()->name : '') }}"
                                   type="text" class="form-control" placeholder="Name" required="">
                        </div>
                        <div class="form-group">
                            <input name="email" value="{{ old('name', Auth::check() ? auth()->user()->email : '' ) }}"
                                   type="email" class="form-control" placeholder="Email" required="">
                        </div>
                        <div class="form-group">
                            <textarea name="message" placeholder="Write your message here" class="form-control"
                                      id="message" cols="30" rows="10"></textarea>
                        </div>
                        @if(auth()->check())
                            <button type="submit"
                                    class="btn btn-primary block full-width m-b">Submit
                            </button>
                        @else
                            <button type="button" disabled="true"
                                    class="btn btn-primary block full-width m-b">Submit
                            </button>
                        @endif
                    </form>
    </div>
@endsection

@section('js')

@endsection
