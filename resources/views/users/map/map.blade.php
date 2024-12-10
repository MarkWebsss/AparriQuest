@can('user-access')
@extends('layouts.Users.app')

@section('content')

@if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    
    <!-- Leaflet CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

    <!-- Leaflet Routing Machine CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <style>
        #map {
            height: 100vh;
            width: 100%; 
            position: relative; 
        }

        #shop-info {
            position: absolute; 
            bottom: 20px; 
            left: 20px; 
            background: white;
            border: 1px solid #ccc; 
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            z-index: 1000; 
        }

        /* Style for the search box */
        #search-box {
            position: absolute; 
            top: 10px;
            left: 0; 
            right: 0; 
            margin: 0 auto; 
            z-index: 1000;
            padding: 5px;
            max-width: 600px; 
            width: 100%;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .input-group {
            width: 100%; 
        }
    </style>

    <div id="map">
        <!-- Search Box -->
        <div id="search-box">
            <form action="{{ route('users.search.product') }}" method="get" class="d-flex">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Search Products or Keywords" aria-label="Search Products or Keywords">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Fixed popup for shop info -->
    <div id="shop-info">
        <h4 id="shop-name"></h4>
        <p id="shop-address"></p>
        <p id="shop-phone"></p>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Define the shop's coordinates and details
        var shopLat = {{ $shopLatLng['latitude'] }};
        var shopLng = {{ $shopLatLng['longitude'] }};
        var shopName = `{!! $shopLatLng['businessName'] !!}`;
        var shopAddress = `{{ $shopLatLng['fullAddress'] }}`;
        var shopPhone = `{{ $shopLatLng['businessPhone'] }}`;

        // Initialize the map
        var map = L.map('map').setView([shopLat, shopLng], 16);

        // Add tile layer for the map
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // non draggable marker
        var shopMarker = L.marker([shopLat, shopLng], { draggable: false }).addTo(map);

        document.getElementById('shop-name').innerText =`Shop: ${shopName}`;
        document.getElementById('shop-address').innerText = `Address: ${shopAddress}`;
        document.getElementById('shop-phone').innerText = `Phone: ${shopPhone}`;

        var userMarker; 
        var routingControl; 

        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(
                function(position) {
                    var userLatLng = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    if (userMarker) {
                        userMarker.setLatLng(userLatLng);
                    } else {
                        userMarker = L.marker(userLatLng, { draggable: false }).addTo(map)
                            .bindPopup('Your Location')
                            .openPopup();
                    }

                    if (routingControl) {
                        map.removeControl(routingControl);
                    }

                    routingControl = L.Routing.control({
                        waypoints: [
                            L.latLng(userLatLng.lat, userLatLng.lng),
                            L.latLng(shopLat, shopLng)
                        ],
                        routeWhileDragging: false
                    }).addTo(map);
                },
                function(error) {
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            alert("User denied the request for Geolocation.");
                            break;
                        case error.POSITION_UNAVAILABLE:
                            alert("Location information is unavailable.");
                            break;
                        case error.TIMEOUT:
                            alert("The request to get user location timed out.");
                            break;
                        case error.UNKNOWN_ERROR:
                            alert("An unknown error occurred.");
                            break;
                    }
                },
                {
                    enableHighAccuracy: true,
                    maximumAge: 10000,
                    timeout: 5000
                }
            );
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    });
    </script>
@endsection
@endcan
