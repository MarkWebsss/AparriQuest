@extends('layouts.Users.app')

@section('content')
    <!-- Leaflet CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Leaflet Routing Machine CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <style>
        #map {
            height: 100vh; /* Set the height of the map */
            width: 100%; /* Full width */
            position: relative; /* Set position relative for absolute children */
        }

        /* Style for the fixed popup */
        #shop-info {
            position: absolute; /* Absolute positioning */
            bottom: 20px; /* Position from the bottom */
            left: 20px; /* Position from the left */
            background: white; /* Popup background */
            border: 1px solid #ccc; /* Popup border */
            padding: 10px; /* Padding for the popup */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); /* Box shadow */
            z-index: 1000; /* Ensure it appears above other elements */
        }

        /* Style for the search box */
        #search-box {
            position: absolute; /* Positioning within the map */
            top: 10px;
            left: 0; /* Align it to the left of the map */
            right: 0; /* Align it to the right of the map */
            margin: 0 auto; /* Center it horizontally */
            z-index: 1000;
            padding: 5px;
            max-width: 600px; /* Set a max width */
            width: 100%; /* Take full width until max width */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .input-group {
            width: 100%; /* Ensure the input group takes full width */
        }
    </style>

    <div id="map">
        <!-- Search Box -->
        <div id="search-box">
            <form action="{{ route('users.searchproducts') }}" method="get" class="d-flex">
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
        var shopName = '{{ $shopLatLng['businessName'] }}';
        var shopAddress = '{{ $shopLatLng['fullAddress'] }}';
        var shopPhone = '{{ $shopLatLng['businessPhone'] }}';

        // Initialize the map
        var map = L.map('map').setView([shopLat, shopLng], 16);

        // Add tile layer for the map
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Add the shop marker (non-draggable)
        var shopMarker = L.marker([shopLat, shopLng], { draggable: false }).addTo(map);

        // Set the shop information in the fixed popup
        document.getElementById('shop-name').innerText = shopName;
        document.getElementById('shop-address').innerText = `Address: ${shopAddress}`;
        document.getElementById('shop-phone').innerText = `Phone: ${shopPhone}`;

        var userMarker; // Variable for user's location marker
        var routingControl; // Variable for routing control

        // Check if geolocation is available and supported
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(
                function(position) {
                    var userLatLng = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Update or create the user's location marker
                    if (userMarker) {
                        // If the marker exists, update its position
                        userMarker.setLatLng(userLatLng);
                    } else {
                        // If the marker does not exist, create it (non-draggable)
                        userMarker = L.marker(userLatLng, { draggable: false }).addTo(map)
                            .bindPopup('Your Location')
                            .openPopup();
                    }

                    // Remove the existing route if it exists
                    if (routingControl) {
                        map.removeControl(routingControl);
                    }

                    // Create a route from the user's location to the shop
                    routingControl = L.Routing.control({
                        waypoints: [
                            L.latLng(userLatLng.lat, userLatLng.lng),
                            L.latLng(shopLat, shopLng)
                        ],
                        routeWhileDragging: false // Prevent new pins from being created when dragging
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
