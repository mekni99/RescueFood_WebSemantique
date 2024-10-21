@extends('layouts.app') <!-- Assurez-vous d'utiliser le bon layout -->

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Delivery Map'])
    <h1>Ma carte</h1>
    <div id="map" style="height: 500px;"></div>

    <script>
        function initMap() {
            // Coordonnées d'Esprit Engineering, Tunisie
            var location = { lat: 36.8512, lng: 10.1818 }; // Remplacez par vos coordonnées

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: location
            });

            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKaWrhppCot0TjGpUI44bpPxY3LqAuDBA&callback=initMap">
    </script>
@endsection
