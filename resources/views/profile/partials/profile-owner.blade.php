<section>
    <div class="container">
        <h1>Edit Business</h1>

        @if(isset($business))
            <h1>{{ $business->businessName }}</h1>
        @else
            <p class="warning-message">No business data available.</p>
        @endif
    </div>
</section>
