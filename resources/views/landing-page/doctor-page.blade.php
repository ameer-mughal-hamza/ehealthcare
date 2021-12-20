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

@section('nav')
    @include('landing-page/nav')
@endsection

@section('content')
    <div class="doctor-banner">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Find a Doctor</h1>
                        <a href="{{ url('/find-a-doctor') }}" class="btn btn-primary btn-lg">View all Doctors</a>
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
                            <select name="s_location" id="s_location" style="height: 36px;"
                                    class="select2_location form-control">
                                <option value="">--- Select Area ---</option>
                                @foreach($municipalities as $municipality)
                                    <option
                                        value="{{ $municipality['zip'] }}">{{ $municipality['zip'] . ', ' . $municipality['city']}}</option>
                                @endforeach
                            </select>
                            <span class="input-group-prepend">
                            <button type="button" class="btn btn-primary search">
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
                            <i class="fa fa fa-stethoscope" style="margin-top: 4px"></i>
                            <span style="margin-left: 15px">By Service</span>
                        </h1>
                        <div class="input-group m-b">
                            <select name="s_service" id="s_service" style="height: 36px;"
                                    class="select2_service form-control">
                                <option value="">--- Select Service ---</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="input-group-prepend">
              <button type="button" class="btn btn-primary search">
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
                        <h1 style="display: flex; justify-content: center; margin-bottom: 60px">
                            <i class="fa fa-user" style="margin-top: 4px"></i>
                            <span style="margin-left: 15px">By Name</span>
                        </h1>
                        <div class="input-group m-b">
                            <input type="text" name="s_name" placeholder="Search by name" id="s_name" class="form-control "/>
                            <span class="input-group-prepend">
                                <button type="button" class="btn btn-primary search">
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
            @include('landing-page/search_doctors_grid_result', ['result' => $doctors])
        </div>
        <div class="row" id="list-view">
            <div class="col-md-6 doctor-list">
                @include('landing-page/search_doctors_result', ['result' => $doctors])
            </div>
            <div class="col-md-6">
                <div id="map"></div>
            </div>
        </div>
    </section>
    @include("landing-page/footer")
@endsection

@section('landing-js')
    <script type="text/javascript">
        $(document).ready(function () {
            let features;

            $(".select2_location").select2({
                theme: 'bootstrap4',
            });

            $(".select2_service").select2({
                theme: 'bootstrap4',
            });

            $(".search").click(function () {
                var location = $("#s_location option:selected").text();
                var service = $("#s_service option:selected").text();
                var name = $("#s_name").val();
                $.ajax({
                    url: "/api/search-doctor",
                    type: "POST",
                    data: {
                        payload: {
                            location,
                            service,
                            name
                        }
                    },
                    success: function (result) {
                        $(".doctor-list").html(result.list);
                        $("#grid-view").html(result.grid);
                        features = result.features;

                        mapboxgl.accessToken = 'pk.eyJ1IjoiYW1laGFtemEiLCJhIjoiY2t3Zm51cXl3MDAybTJ3bmtkZjNodmxxeiJ9.xtY07eJbX8AtWL5ezsLbxQ';
                        navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
                            enableHighAccuracy: true
                        });
                    },
                    error: function (result) {
                        console.log(result);
                    },
                    complete: function (result) {
                    }
                })
            });

            function successLocation(position) {
                // setupMap([position.coords.longitude, position.coords.latitude])
                setupMap([4.70, 50.8476])
            }

            function errorLocation() {
                setupMap([4.70, 50.8476])
            }

            function setupMap(center) {
                const map = new mapboxgl.Map({
                    container: "map",
                    style: "mapbox://styles/mapbox/streets-v11",
                    center: center,
                    zoom: 10
                })
                map.addControl(new mapboxgl.FullscreenControl());

                features = JSON.parse(features);
                for (const feature of features.features) {
                    // create a HTML element for each feature
                    const el = document.createElement('div');
                    el.className = 'marker';

                    // make a marker for each feature and add to the map
                    new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).setPopup(
                        new mapboxgl.Popup({offset: 25}) // add popups
                            .setHTML(
                                `<h3 title="Name">${feature.properties.title}</h3><p title="Language">${feature.properties.language}</p><p title="Contact No">${feature.properties.mobile}</p><p title="Description">${feature.properties.description.substring(0, 50)}</p>`
                            )
                    ).addTo(map);
                }
            }
        });
    </script>
@endsection
