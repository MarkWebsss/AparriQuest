<nav class="h-full py-4 px-3">
    <ul class="space-y-4">
        <li>
            <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-blue-500">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('users.index') }}" class="text-gray-900 hover:text-blue-500">Users</a>
        </li>
        <li>
            <a href="{{ route('users.feedback.create') }}" class="text-gray-900 hover:text-blue-500">Send Feedback</a>
        </li>
        <li>
            <a href="{{ route('users.myfeedback') }}" class="text-gray-900 hover:text-blue-500">My Feedbacks</a>
        </li>
        <li>
            <a href="{{ route('users.products.index') }}" class="text-gray-900 hover:text-blue-500">All Products</a>
        </li>
    </ul>
</nav>
