@can('owner-access')
@extends('layouts.Owner.app')
@section('page-title', 'Dashboard')
@section('content')

<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 text-gray-900">
            <div class="container">
                <div class="row">
                    @if(!$business)
                    <div class="alert alert-warning">
                        <h4 class="text-center">No Shop Claimed</h4>
                        <p class="text-center">You have not claimed a shop yet. Please claim your shop using the TIN number provided during registration.</p>
                        <form action="{{ route('claim-shop') }}" method="POST" class="d-flex justify-content-center">
                            @csrf
                            <input type="text" name="businessName" class="form-control w-50" placeholder="Enter TIN Number" required>
                            <button type="submit" class="btn btn-success ml-2">Claim Shop</button>
                        </form>
                        @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="pt-2 ps-2 flex-grow-1 text-lg">Welcome, {{ Auth::user()->name }}!</h2>
                        <div id="clock" class="border rounded p-3 bg-success text-white" style="font-size: 1.2rem; right: 70px; z-index: 1000;">
                            <span id="current-time" class="font-weight-bold"></span>
                        </div>
                        <script>
                            function updateClock() {
                                const clockElement = document.getElementById('current-time');
                                const now = new Date();
                                const hours = now.getHours().toString().padStart(2, '0');
                                const minutes = now.getMinutes().toString().padStart(2, '0');
                                const seconds = now.getSeconds().toString().padStart(2, '0');
                                const timeString = `${hours}:${minutes}:${seconds}`;
                                clockElement.textContent = timeString;
                            }
                            setInterval(updateClock, 1000);
                            updateClock();
                        </script>
                    </div>
                </div>

                <div class="row d-flex align-items-stretch">
                    <!-- Shop Views Card -->
                    <div class="col-lg-4 col-md-4 mb-3">
                        <div class="card shadow border-light hover-card equal-height">
                            <div class="card-header text-center bg-primary text-white"><b>Shop Views</b></div>
                            <div class="card-body">
                                <h2>{{ $business->businessName }}</h2>
                                <p>Total Views: <span class="font-weight-bold"><strong>{{ $viewCount }}</strong></span></p>
                                <a href="{{ route('owner.business.edit', ['id' => $business->id]) }}">My Business Profile</a>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Ratings Card -->
                    <div class="col-lg-4 col-md-4 mb-3">
                        <div class="card shadow border-light hover-card equal-height">
                            <div class="card-header text-center bg-warning text-white"><b>Customer Ratings Breakdown</b></div>
                            <div class="card-body mb-2">
                                <div class="text-center mb-3">
                                    @if($feedbacks->isEmpty())
                                        <p>No feedback yet for your Shop.</p>
                                    @else
                                        <div class="star-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="star {{ $i <= $averageRating ? 'selected' : '' }}">&#9733;</span>
                                            @endfor
                                        </div>
                                        <p>Average Rating: {{ number_format($averageRating, 1) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Statistics Card -->
                    <div class="col-lg-4 col-md-4 mb-3">
                        <div class="card shadow border-light hover-card equal-height">
                            <div class="card-header text-center bg-success text-white"><b>Product Statistics</b></div>
                            <div class="card-body mb-4">
                                <div class="row">
                                    <div class="col-6 align-self-center">
                                        <h6 class="">Total Products</h6>
                                        <h1 class="font-weight-bold">{{ $productCount }}</h1>
                                        <p>products</p>
                                    </div>

                                    <div class="col-6 align-self-center">
                                        <h6 class="font-weight-bold">Status</h6>
                                        <p class="mt-2">Available: <span class="text-success">{{ $availableStockCount }}</span></p>
                                        <p class="mt-2">Out of Stock: <span class="text-danger">{{ $outOfStockCount }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($business)
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="card shadow border-light">
                            <div class="card-header text-center bg-info text-white"><b>Shop Views Per Second</b></div>
                            <div class="card-body">
                                <canvas id="myLineChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const shopViewsUrl = "{{ route('owner.shop.views.graph') }}"; 

                        fetch(shopViewsUrl)
                            .then(response => response.json())
                            .then(data => {
                                if (data.error) {
                                    console.error(data.error);
                                    return;
                                }

                                const ctx = document.getElementById('myLineChart').getContext('2d');
                                new Chart(ctx, {
                                    type: 'line', 
                                    data: {
                                        labels: data.timestamps,
                                        datasets: [{
                                            label: 'Daily Shop Views',
                                            data: data.viewCounts,
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            fill: false,
                                            borderWidth: 2,
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        scales: {
                                            x: { title: { display: true, text: 'Date (YYYY-MM-DD)' }},
                                            y: { title: { display: true, text: 'Views' }, ticks: { stepSize: 1 }}
                                        }
                                    }
                                });
                            })
                            .catch(error => console.error('Error fetching data:', error));
                    });
                </script>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

<style>
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-card:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .star-rating {
        display: inline-block;
    }

    .star {
        color: gray; /* Default color for unselected stars */
        font-size: 24px; /* Size of the stars */
        margin: 0 2px; /* Space between stars */
    }

    .star.selected {
        color: gold; /* Color for selected stars */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mask the name in the feedback
        const maskedNames = document.querySelectorAll('.masked-name');

        maskedNames.forEach(function(element) {
            const fullName = element.getAttribute('data-name');
            const maskedName = maskName(fullName);
            element.textContent = maskedName;
        });

        // Function to mask the name
        function maskName(name) {
            const nameParts = name.split(' ');
            const maskedNameParts = nameParts.map(part => {
                if (part.length > 2) {
                    return part[0] + '*'.repeat(part.length - 1);
                }
                return part; // Keep initials or short parts unchanged
            });
            return maskedNameParts.join(' ');
        }
    });
</script>
<style>
    .equal-height {
    height: 100%;
}
</style>
@endsection
@endcan
