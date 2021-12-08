@extends('master-landing')

@section('title', "E Health Care - Home")

@section('landing-css')
    <style>
        body {
            margin: 0;
        }
        #map {
            height: 100vh;
            width: 100vw;
        }
    </style>
@endsection

@section('landing-js')
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiYW1laGFtemEiLCJhIjoiY2t3Zm51cXl3MDAybTJ3bmtkZjNodmxxeiJ9.xtY07eJbX8AtWL5ezsLbxQ';
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-74.5, 40],
        zoom: 9
    });
</script>
@endsection
