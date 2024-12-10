@can('owner-access')
@extends('layouts.Owner.app')
@section('page-title', 'User Feedbacks')
@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="container mx-auto">
    <!-- Check if the business is claimed or not -->
    @if (!Auth::user()->business)
        <div class="alert alert-warning alert-dismissible fade show m-5" role="alert" style="border-radius: 8px; position: relative; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <strong>Warning!</strong> You must claim a shop to see your shop's feedbacks.
            <a href="{{ route('owner.dashboard') }}" class="btn btn-link font-weight-bold" style="text-decoration: underline; padding-left: 0;">Go Claim Shop</a>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute; right: 10px; top: 10px;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @else
        <h3 class="text-center text-2xl font-semibold my-4">Feedback for {{ $business->businessName }}</h3>

        @if($feedbacks->isEmpty())
            <p class="text-center text-gray-500">No feedbacks yet.</p>
        @else
            <!-- Rating Filter -->
            <div class="flex justify-center space-x-4 mb-6 flex-wrap">
                <button class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 mb-2 sm:mb-0"
                        onclick="filterFeedback(0)">
                    All
                </button>
                @foreach(range(1, 5) as $rating)
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 mb-2 sm:mb-0"
                            onclick="filterFeedback({{ $rating }})">
                        {{ $rating }} Star{{ $rating > 1 ? 's' : '' }}
                    </button>
                @endforeach
            </div>

            <!-- Feedback Display for Specific Rating -->
            <div id="feedback-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach($feedbacks as $feedback)
                    <div class="bg-white shadow-md rounded-lg p-4 feedback-item" data-rating="{{ $feedback->rating }}">
                        <div class="flex justify-between items-center">
                            <h5 class="text-lg font-semibold text-gray-700">{{ substr($feedback->user->name, 0, 1) }}****</h5>
                            <small class="text-sm text-gray-400">{{ $feedback->created_at->format('d M Y') }}</small>
                        </div>
                        <div class="flex mt-2">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="star text-lg {{ $i <= $feedback->rating ? 'text-yellow-500' : 'text-gray-300' }}">&#9733;</span>
                            @endfor
                        </div>
                        <p class="mt-2 text-gray-600 text-sm">{{ $feedback->message }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>

<script>
    // JavaScript function to filter feedback by rating
    function filterFeedback(rating) {
        const feedbackItems = document.querySelectorAll('.feedback-item');
        feedbackItems.forEach(item => {
            const itemRating = parseInt(item.getAttribute('data-rating'));
            if (rating === 0 || itemRating === rating) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Optional: Show all feedback initially
    filterFeedback(0); // 0 means no filter, show all feedback
</script>

@endsection
@endcan
