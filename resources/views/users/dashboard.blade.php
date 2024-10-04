@can('user-access')
    @extends('layouts.Users.app')

    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900">
                <div class="container rounded p-5 text-center bg-success">
                    <h1><b>AparriQuest</b></h1>
                    <br>
                    <p>Can't find the product that you need? Just click the search button!</p>
                    <form action="" method="">
                        <center>
                            <input type="search" name="" class="form-control form-control-md rounded-pill" style="width: 500px;" id="" placeholder="Search Products">
                        </center>
                        <button type="submit" class="btn btn-primary m-2 p-2">Search</button>
                        <a href="{{ route('users.index') }}" class="btn btn-primary m-2 p-2">Make an Online Shop</a>
                    </form>
                </div>

                <!-- Map container -->
                <div class="container mt-4">
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Leaflet.js CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        // Initialize the map with a default view (this will change based on user location)
        var map = L.map('map').setView([18.3539, 121.6401], 13);  // Aparri, Cagayan coordinates as default

        // Add a tile layer (OpenStreetMap in this case)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Check if the browser supports Geolocation API
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                // Get the latitude and longitude from the geolocation API
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;

                // Center the map to the user's current location
                map.setView([lat, lon], 13);

                // Add a marker to the user's current location
                var marker = L.marker([lat, lon]).addTo(map);
                marker.bindPopup("<b>You are here!</b><br>Your current location.").openPopup();
            }, function(error) {
                console.log("Geolocation error: " + error.message);
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    </script>
    @endsection
@endcan
