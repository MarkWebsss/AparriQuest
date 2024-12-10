<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AparriQuest') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('build/bootstrap/bootstrap.v5.3.2.min.css') }}">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<section id="about-us" class="py-5 bg-light">
    <div class="container">
        <!-- About the Project -->
        <div class="row mb-5">
            <div class="col-md-6">
                <img src="{{ asset('images/about-project.jpg') }}" alt="About the Project" class="img-fluid rounded shadow-sm">
            </div>
            <div class="col-md-6">
                <h2 class="mb-3">About AparriQuest</h2>
                <p>
                    AparriQuest is a shop finder system designed to help the community locate shops and products in Aparri conveniently. Our mission is to promote local commerce and provide users with a seamless experience in finding what they need.
                </p>
                <p>
                    By combining technology with local business needs, we strive to empower shop owners and improve accessibility for customers.
                </p>
            </div>
        </div>

        <!-- Meet the Team -->
        <div class="row text-center">
            <h3 class="mb-4">Meet Our Team</h3>
            <!-- Team Member 1 -->
            <div class="col-md-3">
                <div class="card border-0">
                    <img src="{{ asset('images/member1.jpg') }}" alt="Member 1" class="card-img-top rounded-circle img-fluid shadow-sm" style="width: 150px; height: 150px; margin: 0 auto;">
                    <div class="card-body">
                        <h5 class="card-title">Member 1</h5>
                        <p class="card-text">Role: Developer</p>
                    </div>
                </div>
            </div>
            <!-- Team Member 2 -->
            <div class="col-md-3">
                <div class="card border-0">
                    <img src="{{ asset('images/member2.jpg') }}" alt="Member 2" class="card-img-top rounded-circle img-fluid shadow-sm" style="width: 150px; height: 150px; margin: 0 auto;">
                    <div class="card-body">
                        <h5 class="card-title">Member 2</h5>
                        <p class="card-text">Role: Designer</p>
                    </div>
                </div>
            </div>
            <!-- Team Member 3 -->
            <div class="col-md-3">
                <div class="card border-0">
                    <img src="{{ asset('images/member3.jpg') }}" alt="Member 3" class="card-img-top rounded-circle img-fluid shadow-sm" style="width: 150px; height: 150px; margin: 0 auto;">
                    <div class="card-body">
                        <h5 class="card-title">Member 3</h5>
                        <p class="card-text">Role: Content Manager</p>
                    </div>
                </div>
            </div>
            <!-- Team Member 4 -->
            <div class="col-md-3">
                <div class="card border-0">
                    <img src="{{ asset('images/member4.jpg') }}" alt="Member 4" class="card-img-top rounded-circle img-fluid shadow-sm" style="width: 150px; height: 150px; margin: 0 auto;">
                    <div class="card-body">
                        <h5 class="card-title">Member 4</h5>
                        <p class="card-text">Role: Project Manager</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
