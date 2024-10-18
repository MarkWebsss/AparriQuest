@can('owner-access')
@extends('layouts.Owner.app')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 text-gray-900">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 me-2 mb-2">
                        <h1>Welcome, {{ Auth::user()->name }}</h1>
                    </div>
                    
                    <div class="col card bg-success">
                        <div class="card-header">Profile</div>
                        <img src="{{ asset('logo/logo1.png') }}" alt="Logo" 
                             class="logo mx-auto rounded" width="100" height="100">
                        <a href="" class="d-flex justify-content-center align-items-center text-white"
                           style="outline:none; text-decoration: none;">+ Edit Bio</a>

                        <div class="text-center">
                            <a href="{{ route('profile.edit') }}" class="btn btn-light text-dark w-100 mb-2">Edit Profile</a>
                        </div>
                        <div class="text-center">
                        <a href="{{ route('products.index') }}" class="btn btn-light text-dark w-100 mb-2">Add Products</a>

                        </div>
                        <div class="text-center">
                            <a href="" class="btn btn-light text-dark w-100 mb-2">View Feedbacks</a>
                        </div>
                        <div class="text-center">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-light text-dark w-100 mb-2">
                                    {{ __('Logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-4 card me-2">
                        <div class="card-header text-center"><b>Views</b></div>
                        <canvas id="myLineChart"></canvas>
                    </div>

                    <!-- Replace the Rate Line Chart with Star Rating Breakdown -->
                    <div class="col-sm-4 card me-2">
                        <div class="card-header text-center"><b>Customer Ratings Breakdown</b></div>
                        <div class="p-3">
                            <!-- Overall star rating -->
                            <div class="star-rating text-center mb-3">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <p>4.5 Average Rating</p>
                            </div>

                            <!-- Ratings Breakdown with progress bars -->
                            <div class="rating-bar">
                                <span>5 star</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 80%;"></div>
                                </div>
                                <span>80%</span>
                            </div>

                            <div class="rating-bar">
                                <span>4 star</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;"></div>
                                </div>
                                <span>60%</span>
                            </div>

                            <div class="rating-bar">
                                <span>3 star</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%;"></div>
                                </div>
                                <span>40%</span>
                            </div>

                            <div class="rating-bar">
                                <span>2 star</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 20%;"></div>
                                </div>
                                <span>20%</span>
                            </div>

                            <div class="rating-bar">
                                <span>1 star</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;"></div>
                                </div>
                                <span>10%</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Views Graph -->
<script>
    // Get the canvas element for views
    var ctx = document.getElementById('myLineChart').getContext('2d');

    // Create the line chart for views
    var myLineChart = new Chart(ctx, {
        type: 'line', // Define chart type
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'], // X-axis labels
            datasets: [{
                label: 'Shop Views/Visits', // Chart label
                data: [100, 200, 150, 200, 150, 50], // Data points for the line
                borderColor: 'rgba(75, 192, 192, 1)', // Line color
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Area under the line (transparent fill)
                borderWidth: 2 // Line thickness
            }]
        },
        options: {
            responsive: true, // Make the chart responsive
            scales: {
                y: {
                    beginAtZero: true // Start the Y-axis at 0
                }
            }
        }
    });
</script>

<!-- Floating Button -->
<button id="floatButton" class="float-button btn btn-success" data-bs-toggle="modal" data-bs-target="#profileModal">
    <img src="{{ asset('logo/logo1.png') }}" alt="Logo" width="30" height="30">
</button>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('logo/logo1.png') }}" alt="Logo" 
                     class="logo mx-auto rounded" width="100" height="100">
                <a href="" class="d-flex justify-content-center align-items-center text-white"
                   style="outline:none; text-decoration: none;">+ Edit Bio</a>

                <div class="text-center mb-3">
                    <a href="{{ route('profile.edit') }}" class="btn btn-light text-dark w-100 mb-2">Edit Profile</a>
                </div>
                <div class="text-center mb-3">
                    <a href="" class="btn btn-light text-dark w-100 mb-2">Add Products</a>
                </div>
                <div class="text-center mb-3">
                    <a href="" class="btn btn-light text-dark w-100 mb-2">View Feedbacks</a>
                </div>

                <div class="text-center mb-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-light text-dark w-100 mb-2">
                            {{ __('Logout') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add your CSS for floating button -->
<style>
    .float-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999; /* Ensure it's on top */
        transition: all 0.3s ease;
        display: none; /* Hide by default */
    }

    .show {
        display: block; /* Show the button */
    }
</style>

<!-- JavaScript for floating button -->
<script>
    window.onscroll = function() {
        toggleFloatButton();
    };

    function toggleFloatButton() {
        var button = document.getElementById("floatButton");
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            button.classList.add("show");
        } else {
            button.classList.remove("show");
        }
    }
</script>

<!-- Font Awesome for star icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

@endcan
@endsection
