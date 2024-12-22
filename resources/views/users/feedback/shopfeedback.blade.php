@can('user-access')

    @extends('layouts.Users.app')
    @section('content')
    <style>
        .star-rating {
            display: flex;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .star {
            font-size: 40px;
            color: gray;
            transition: color 0.3s ease, transform 0.2s ease;
            margin-right: 5px;
        }

        .star:hover,
        .star.selected {
            color: gold;
            transform: scale(1.2);
        }

        .star-rating-container {
            display: flex;
            align-items: center;
        }

        #rating-value {
            font-weight: bold;
            font-size: 16px;
            margin-left: 10px;
            color: #666;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        .form-control {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .feedback-form {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: auto;
        }

        .feedback-form label {
            font-size: 16px;
            font-weight: bold;
        }

        .feedback-form textarea {
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            font-size: 14px;
            border: 1px solid #ddd;
            resize: vertical;
        }

        .feedback-form textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        .feedback-form button {
            margin-top: 10px;
            width: 100%;
        }

        .shop-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

    </style>
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('users.shop.index') }}" class="btn btn-danger my-3">Back to Shop</a>
    <div class="feedback-form mt-4">
        <!-- Display the Shop Name -->
        <div class="shop-name">
            Rating for: <span>{{ $business->businessName }}</span>
        </div>

        <form action="{{ route('users.shop-feedback.store') }}" method="POST">
            @csrf
            <input type="hidden" name="business_id" value="{{ $business->id }}">

            <div class="mb-3">
                <label for="rating">Rating:</label>
                <div class="star-rating">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star" data-value="{{ $i }}">&#9733;</span>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="rating" value="">
            </div>

            <div class="mb-3">
                <label for="message">Feedback:</label>
                <textarea name="message" id="message" rows="4" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Feedback</button>
        </form>
    </div>

    @endsection

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const stars = document.querySelectorAll(".star");
            const hiddenRating = document.getElementById("rating");

            stars.forEach(star => {
                star.addEventListener("click", function () {
                    const rating = this.getAttribute("data-value");
                    hiddenRating.value = rating;  // Set the rating value in the hidden input field

                    // Highlight the selected star and all previous ones
                    stars.forEach(star => star.classList.remove("selected"));
                    for (let i = 0; i < rating; i++) {
                        stars[i].classList.add("selected");
                    }
                });

                star.addEventListener("mouseover", function () {
                    const rating = this.getAttribute("data-value");
                    // Highlight stars on hover
                    stars.forEach((star, index) => {
                        star.style.color = index < rating ? "gold" : "gray";
                    });
                });

                star.addEventListener("mouseout", function () {
                    // Reset the color when mouse leaves
                    stars.forEach(star => {
                        star.style.color = star.classList.contains("selected") ? "gold" : "gray";
                    });
                });
            });
        });
    </script>

@endcan
