<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
    <!-- Animation CSS -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet"/>
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2/select2-bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.css" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
        type="text/css"
    />
    <style>
        .marker {
            background-image: url('http://localhost:8000/img/mapbox-icon.png');
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }

        .mapboxgl-popup {
            max-width: 200px;
        }

        .mapboxgl-popup-content {
            text-align: center;
            font-family: 'Open Sans', sans-serif;
        }
    </style>
    @yield("landing-css")
</head>
<body id="page-top" class="landing-page no-skin-config">
@yield('nav')
@yield('content')
<!-- Mainly scripts -->
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- Custom and plugin javascript -->
<script src="{{ asset('js/inspinia.js') }}"></script>
{{--<script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>--}}
<script src="{{ asset('js/plugins/wow/wow.min.js') }}"></script>
<script src="{{ asset('js/plugins/select2/select2.full.min.js') }}"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.js"></script>

<script>
    $(document).ready(function () {
        $("body").scrollspy({
            target: "#navbar",
            offset: 80,
        });

        // Page scrolling feature
        $("a.page-scroll").bind("click", function (event) {
            var link = $(this);
            $("html, body")
                .stop()
                .animate(
                    {
                        scrollTop: $(link.attr("href")).offset().top - 50,
                    },
                    500
                );
            event.preventDefault();
            $("#navbar").collapse("hide");
        });
    });

    mapboxgl.accessToken = 'pk.eyJ1IjoiYW1laGFtemEiLCJhIjoiY2t3Zm51cXl3MDAybTJ3bmtkZjNodmxxeiJ9.xtY07eJbX8AtWL5ezsLbxQ';
    navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
        enableHighAccuracy: true
    })

    function successLocation(position) {
        setupMap([4.70, 50.8476])
        // setupMap([position.coords.longitude, position.coords.latitude])
    }

    function errorLocation() {
        setupMap([4.70, 50.8476])
    }

    function setupMap(center) {
        let features;

        const map = new mapboxgl.Map({
            container: "map",
            style: "mapbox://styles/mapbox/streets-v11",
            center: center,
            zoom: 10
        })
        map.addControl(new mapboxgl.FullscreenControl());

        $.ajax({
            url: "/api/search-doctor/initial",
            type: "POST",
            success: function (result) {
                let features = JSON.parse(result.data);
                for (const feature of features.features) {
                    // create a HTML element for each feature
                    const el = document.createElement('div');
                    el.className = 'marker';

                    // make a marker for each feature and add to the map
                    new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).setPopup(
                        new mapboxgl.Popup({offset: 25}) // add popups
                            .setHTML(
                                `<h3 title="Name">${feature.properties.title}</h3><p title="Language">${feature.properties.language}</p><p title="Contact No">${feature.properties.mobile}</p><p title="Description">${feature.properties.description.substring(0,50)}</p>`
                            )
                    ).addTo(map);
                }
            },
            error: function (result) {

            },
            complete: function (result) {

            }
        })
    }

    var cbpAnimatedHeader = (function () {
        var docElem = document.documentElement,
            header = document.querySelector(".navbar-default"),
            didScroll = false,
            changeHeaderOn = 200;

        function init() {
            window.addEventListener(
                "scroll",
                function (event) {
                    if (!didScroll) {
                        didScroll = true;
                        setTimeout(scrollPage, 250);
                    }
                },
                false
            );
        }

        function scrollPage() {
            var sy = scrollY();
            if (sy >= changeHeaderOn) {
                $(header).addClass("navbar-scroll");
            } else {
                if (!header.classList.contains('navbar-scroll')) {
                    $(header).removeClass("navbar-scroll");
                }
            }
            didScroll = false;
        }

        function scrollY() {
            return window.pageYOffset || docElem.scrollTop;
        }

        init();
    })();

    // Activate WOW.js plugin for animation on scrol
    new WOW().init();

    $("button#grid-btn").click(function () {
        $("button#grid-btn").removeClass("btn-white").addClass("btn-primary");
        $("button#list-btn").removeClass("btn-primary").addClass("btn-white");
        $("div#list-view").addClass("d-none");
        $("div#grid-view").removeClass("d-none");
    });
    $("button#list-btn").click(function () {
        $("button#grid-btn").removeClass("btn-primary").addClass("btn-white");
        $("button#list-btn").removeClass("btn-white").addClass("btn-primary");

        $("div#grid-view").addClass("d-none");
        $("div#list-view").removeClass("d-none");
    });
</script>
@yield('landing-js')
</body>
</html>
