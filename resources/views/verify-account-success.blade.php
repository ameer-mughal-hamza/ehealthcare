@extends('master-landing')
@section('content')
    <div class="container text-center animated fadeInDown mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class='alert alert-info alert-dismissible fade show'>
                    <h4 class='alert-heading'>Congratulation!</h4>
                    <p>Your account has been verified succesfully.</p>
                    <hr>
                    <a href='{{ url('home') }}'>Go to Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection
