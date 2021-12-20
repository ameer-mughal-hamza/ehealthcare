@extends('master-landing')

@section('title', "E Health Care - Home")

@section('nav')
    @include('landing-page/nav')
@endsection

@section('content')
    <div id="inSlider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#inSlider" data-slide-to="0" class="active"></li>
            <li data-target="#inSlider" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div class="container">
                    <div class="carousel-caption blank">
                        <h1>
                            FIND ANY DOCTOR
                        </h1>
                        <p>A platform to find all the doctors with different specializations according to your need with just a single click. Find a doctor by name, location or specialization.</p>
                        <p>
                            <a class="btn btn-lg btn-primary" href="#" role="button"
                            >Learn more</a
                            >
                        </p>
                    </div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back two"></div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="carousel-caption blank">
                        <h1>
                            FIND ANY DOCTOR
                        </h1>
                        <p>A platform to find all the doctors with different specializations according to your need with just a single click. Find a doctor by name, location or specialization.</p>
                        <p>
                            <a class="btn btn-lg btn-primary" href="#" role="button"
                            >Learn more</a
                            >
                        </p>
                    </div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back two"></div>
            </div>
        </div>
        <a
            class="carousel-control-prev"
            href="#inSlider"
            role="button"
            data-slide="prev"
        >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a
            class="carousel-control-next"
            href="#inSlider"
            role="button"
            data-slide="next"
        >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <section id="features" class="container services">
        <div class="row">
            <div class="col-sm-4">
                <h2>Find any doctor</h2>
                <p>A platform to find all the doctors with different specializations according to your need with just a single click. Find a doctor by name, location or specialization. </p>
            </div>
            <div class="col-sm-4">
                <h2>View nearby doctors on a map</h2>
                <p>An emergency? Quickly find doctors nearby your vicinity using our
                    map-based search functionality</p>
            </div>
            <div class="col-sm-4">
                <h2>Simplify Routine Checkups</h2>
                <p>Using our platform you can easily manage all your prescriptions and medical history at one place for quick access in future. See all of your previous doctor visits, prescribed medicines and diagnosis at a glance.</p>
            </div>
        </div>
    </section>
    <div id="map"></div>
    @include('landing-page/footer')
@endsection
