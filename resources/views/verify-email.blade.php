@extends('master-landing')
@section('content')
    <div class="container text-center animated fadeInDown mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Congratulations!</h4>
                    <p>You successfully registered in our system. Please verify your account.</p>
                    <hr>
                    <p class="mb-0">An email is already sent to your account with necessary details.</p>
                    <a href="{{ url('/home') }}">Go to Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection
