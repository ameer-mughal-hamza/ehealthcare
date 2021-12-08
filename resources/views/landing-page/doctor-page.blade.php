@extends('master-landing')

@section('title', "E Health Care - Home")

@section('landing-css')
    <style>
        body {
            margin: 0;
        }

        #map {
            height: 700px;
            width: 100vw;
        }

        .doctor-list {
            height: 700px;
            overflow-y: scroll;
        }
    </style>
@endsection

@section('content')
@section('nav')
    @include('landing-page/nav')
@endsection
<div class="doctor-banner">
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Find a Doctor</h1>
                    <button class="btn btn-primary btn-lg">View all Doctors</button>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back one"></div>
        </div>
    </div>
</div>
<section class="container" style="margin-top: -70px">
    <div class="row">
        <div class="col-lg-4">
            <div class="contact-box center-version">
                <div class="ibox-content text-center" style="
            border: 1px solid #f5f5f5;
            border-radius: 9px;
            box-shadow: 5px 10px #f5f5f5;
          ">
                    <h1 style="display: flex; justify-content: center; margin-bottom: 60px">
                        <i class="fa fa-location-arrow" style="margin-top: 4px"></i>
                        <span style="margin-left: 15px">By Location</span>
                    </h1>
                    <div class="input-group m-b">
                        <input type="text" class="form-control"/>
                        <span class="input-group-prepend">
                            <button type="button" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="contact-box center-version">
                <div class="ibox-content text-center" style="
            border: 1px solid #f5f5f5;
            border-radius: 9px;
            box-shadow: 5px 10px #f5f5f5;
          ">
                    <h1
                        style="display: flex; justify-content: center; margin-bottom: 60px"
                    >
                        <i class="fa fa-location-arrow" style="margin-top: 4px"></i>
                        <span style="margin-left: 15px">By Service</span>
                    </h1>
                    <div class="input-group m-b">
                        <input type="text" class="form-control"/>
                        <span class="input-group-prepend">
              <button type="button" class="btn btn-primary">
                <i class="fa fa-search"></i>
              </button>
            </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="contact-box center-version">
                <div
                    class="ibox-content text-center"
                    style="
            border: 1px solid #f5f5f5;
            border-radius: 9px;
            box-shadow: 5px 10px #f5f5f5;
          "
                >
                    <h1
                        style="display: flex; justify-content: center; margin-bottom: 60px"
                    >
                        <i class="fa fa-location-arrow" style="margin-top: 4px"></i>
                        <span style="margin-left: 15px">By Name</span>
                    </h1>
                    <div class="input-group m-b">
                        <input type="text" class="form-control"/>
                        <span class="input-group-prepend">
              <button type="button" class="btn btn-primary">
                <i class="fa fa-search"></i>
              </button>
            </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container" id="doctor-search-result" style="margin-top: 70px">
    <div class="row mb-5">
        <div class="col-md-12 text-right">
            <div class="btn-group">
                <button id="list-btn" class="btn btn-primary" type="button">List <i class="fa fa-list"></i></button>
                <button id="grid-btn" class="btn btn-white" type="button">Grid <i class="fa fa-th"></i></button>
            </div>
        </div>
    </div>
    <hr>
    <div class="row d-none" id="grid-view">
        <div class="col-lg-4">
            <div class="contact-box center-version">
                <a href="{{ url('/doctor-find/1') }}">
                    <img
                        alt="image"
                        class="rounded-circle"
                        src="{{ url('img/landing/avatar2.jpg') }}"
                    />

                    <h3 class="m-b-xs"><strong>John Smith</strong></h3>

                    <div class="font-bold">Graphics designer</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br/>
                        795 Folsom Ave, Suite 600<br/>
                        San Francisco, CA 94107<br/>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>
                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a href="" class="btn btn-xs btn-white"
                        ><i class="fa fa-phone"></i> Call
                        </a>
                        <a href="" class="btn btn-xs btn-white"
                        ><i class="fa fa-envelope"></i> Email</a
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="contact-box center-version">
                <a href="{{ url('/doctor-find/1') }}">
                    <img
                        alt="image"
                        class="rounded-circle"
                        src="{{ url('img/landing/avatar2.jpg') }}"
                    />

                    <h3 class="m-b-xs"><strong>John Smith</strong></h3>

                    <div class="font-bold">Graphics designer</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br/>
                        795 Folsom Ave, Suite 600<br/>
                        San Francisco, CA 94107<br/>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>
                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a href="" class="btn btn-xs btn-white"
                        ><i class="fa fa-phone"></i> Call
                        </a>
                        <a href="" class="btn btn-xs btn-white"
                        ><i class="fa fa-envelope"></i> Email</a
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="contact-box center-version">
                <a href="{{ url('/doctor-find/1') }}">
                    <img
                        alt="image"
                        class="rounded-circle"
                        src="{{ url('img/landing/avatar2.jpg') }}"
                    />

                    <h3 class="m-b-xs"><strong>John Smith</strong></h3>

                    <div class="font-bold">Graphics designer</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br/>
                        795 Folsom Ave, Suite 600<br/>
                        San Francisco, CA 94107<br/>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>
                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a href="" class="btn btn-xs btn-white"
                        ><i class="fa fa-phone"></i> Call
                        </a>
                        <a href="" class="btn btn-xs btn-white"
                        ><i class="fa fa-envelope"></i> Email</a
                        >
                        <a href="" class="btn btn-xs btn-white"
                        ><i class="fa fa-user-plus"></i> Follow</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="list-view">
        <div class="col-md-6 doctor-list">
            <div class="contact-box">
                <a class="row" href="{{ url('/doctor-detail/1') }}">
                    <div class="col-4">
                        <div class="text-center">
                            <img alt="image" class="rounded-circle m-t-xs img-fluid"
                                 src="{{ url('img/landing/avatar2.jpg') }}">
                            <div class="m-t-xs font-bold">Graphics designer</div>
                        </div>
                    </div>
                    <div class="col-8">
                        <h3><strong>John Smith</strong></h3>
                        <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                        <address>
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                    </div>
                </a>
            </div>
            <div class="contact-box">
                <a class="row" href="{{ url('/doctor-detail/1') }}">
                    <div class="col-4">
                        <div class="text-center">
                            <img alt="image" class="rounded-circle m-t-xs img-fluid"
                                 src="{{ url('img/landing/avatar2.jpg') }}">
                            <div class="m-t-xs font-bold">Graphics designer</div>
                        </div>
                    </div>
                    <div class="col-8">
                        <h3><strong>John Smith</strong></h3>
                        <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                        <address>
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                    </div>
                </a>
            </div>
            <div class="contact-box">
                <a class="row" href="{{ url('/doctor-detail/1') }}">
                    <div class="col-4">
                        <div class="text-center">
                            <img alt="image" class="rounded-circle m-t-xs img-fluid"
                                 src="{{ url('img/landing/avatar2.jpg') }}">
                            <div class="m-t-xs font-bold">Graphics designer</div>
                        </div>
                    </div>
                    <div class="col-8">
                        <h3><strong>John Smith</strong></h3>
                        <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                        <address>
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                    </div>
                </a>
            </div>
            <div class="contact-box">
                <a class="row" href="{{ url('/doctor-detail/1') }}">
                    <div class="col-4">
                        <div class="text-center">
                            <img alt="image" class="rounded-circle m-t-xs img-fluid"
                                 src="{{ url('img/landing/avatar2.jpg') }}">
                            <div class="m-t-xs font-bold">Graphics designer</div>
                        </div>
                    </div>
                    <div class="col-8">
                        <h3><strong>John Smith</strong></h3>
                        <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                        <address>
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                    </div>
                </a>
            </div>
            <div class="contact-box">
                <a class="row" href="{{ url('/doctor-detail/1') }}">
                    <div class="col-4">
                        <div class="text-center">
                            <img alt="image" class="rounded-circle m-t-xs img-fluid"
                                 src="{{ url('img/landing/avatar2.jpg') }}">
                            <div class="m-t-xs font-bold">Graphics designer</div>
                        </div>
                    </div>
                    <div class="col-8">
                        <h3><strong>John Smith</strong></h3>
                        <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                        <address>
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                    </div>
                </a>
            </div>
            <div class="contact-box">
                <a class="row" href="{{ url('/doctor-detail/1') }}">
                    <div class="col-4">
                        <div class="text-center">
                            <img alt="image" class="rounded-circle m-t-xs img-fluid"
                                 src="{{ url('img/landing/avatar2.jpg') }}">
                            <div class="m-t-xs font-bold">Graphics designer</div>
                        </div>
                    </div>
                    <div class="col-8">
                        <h3><strong>John Smith</strong></h3>
                        <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                        <address>
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                    </div>
                </a>
            </div>
            <div class="contact-box">
                <a class="row" href="{{ url('/doctor-detail/1') }}">
                    <div class="col-4">
                        <div class="text-center">
                            <img alt="image" class="rounded-circle m-t-xs img-fluid"
                                 src="{{ url('img/landing/avatar2.jpg') }}">
                            <div class="m-t-xs font-bold">Graphics designer</div>
                        </div>
                    </div>
                    <div class="col-8">
                        <h3><strong>John Smith</strong></h3>
                        <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                        <address>
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                    </div>
                </a>
            </div>
            <div class="contact-box">
                <a class="row" href="{{ url('/doctor-detail/1') }}">
                    <div class="col-4">
                        <div class="text-center">
                            <img alt="image" class="rounded-circle m-t-xs img-fluid"
                                 src="{{ url('img/landing/avatar2.jpg') }}">
                            <div class="m-t-xs font-bold">Graphics designer</div>
                        </div>
                    </div>
                    <div class="col-8">
                        <h3><strong>John Smith</strong></h3>
                        <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                        <address>
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div id="map"></div>
        </div>
    </div>
</section>
@include("landing-page/footer")
@endsection
