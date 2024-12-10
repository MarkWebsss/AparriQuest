@can('user-access')
    @extends('layouts.Users.app')

    @section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Feedback Form Section -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Send Feedback</h5>
                    </div>
                    <div class="card-body">
                        <!-- Flashed Message -->
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('users.feedback.store') }}" method="post" class="was-validated">
                            @csrf
                            @method('POST')

                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" readonly value="{{ Auth::user()->email }}" id="email" class="form-control" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="rate" class="form-label">Rating</label>
                                <select name="rate" id="rate" class="form-select" required>
                                    <option value="">-- Select --</option>
                                    <option value="1">Poor</option>
                                    <option value="3">Good</option>
                                    <option value="5">Outstanding</option>
                                </select>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please select a rating.</div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="comments" class="form-label">Comments</label>
                                <textarea name="comm" id="comments" class="form-control" rows="4" required placeholder="Enter your comments here..."></textarea>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please provide your comments.</div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit Feedback</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Feedback List Section -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">My Feedbacks</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Rate</th>
                                    <th>Comment(s)</th>
                                    <th>Date Submitted</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($myfeedbacks as $feedback)
                                    <tr>
                                        <td>{{ $feedback->rate }}</td>
                                        <td>{{ $feedback->comments }}</td>
                                        <td>{{$feedback->created_at}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No feedback found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $myfeedbacks->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
@endcan
