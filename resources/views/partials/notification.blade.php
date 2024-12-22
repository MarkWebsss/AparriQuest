<!-- Notification Bell Button -->
<button class="btn btn-link position-relative" id="notification-btn">
    <i class="fas fa-bell"></i>
    <span class="badge badge-danger badge-pill" id="notification-count">{{ auth()->user()->unreadNotifications->count() }}</span>
</button>

<!-- Modal Structure for Notifications -->
<div class="modal" id="notification-modal">
    <div class="modal-content">
        <!-- Add a "Mark all as read" button -->
<div class="modal-header">
    <h5 class="modal-title">Notifications</h5>
    <button type="button" class="close" id="close-modal">&times;</button>
</div>
<div class="modal-body">
    <button class="btn btn-primary" id="mark-all-read">Mark all as read</button>
    @if(auth()->user()->unreadNotifications->isNotEmpty())
        <div class="list-group">
            @foreach(auth()->user()->unreadNotifications as $notification)
                <a href="{{ $notification->data['url'] }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-id="{{ $notification->id }}">
                    <div>
                        <h5 class="mb-1">
                            {{ $notification->data['title'] ?? 'No title available' }}
                        </h5>
                        <p class="mb-1">
                            {{ $notification->data['message'] ?? 'No message available' }}
                        </p>
                    </div>
                    <span class="badge badge-primary badge-pill">View</span>
                </a>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            <p>No new notifications.</p>
        </div>
    @endif
</div>
    </div>
</div>

<!-- Add FontAwesome for the bell icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    /* Modal Styles */
.modal {
    display: none;  /* Hidden by default */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);  /* Semi-transparent background */
    z-index: 9999;
    display: flex;  /* Enable flexbox */
    justify-content: center;  /* Center horizontally */
    align-items: center;  /* Center vertically */
}

/* Modal Content */
.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 80%;
    max-width: 600px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
}

/* Close Button */
.close {
    font-size: 24px;
    color: #aaa;
    cursor: pointer;
}

.close:hover {
    color: black;
}

/* Button */
#notification-btn {
    position: relative;
}

/* Badge count style */
#notification-count {
    position: absolute;
    top: 0;
    right: 0;
    background-color: red;
    color: white;
    padding: 0.2em 0.5em;
    font-size: 0.8em;
    border-radius: 50%;
}

</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Hide the modal initially
    $('#notification-modal').hide();

    // Toggle modal visibility when the notification button is clicked
    $('#notification-btn').click(function() {
        $('#notification-modal').fadeIn();
    });

    // Close the modal when the close button is clicked
    $('#close-modal').click(function() {
        $('#notification-modal').fadeOut();
    });

    // Close the modal if the user clicks outside the modal content
    $(window).click(function(event) {
        if ($(event.target).is('#notification-modal')) {
            $('#notification-modal').fadeOut();
        }
    });

    $('.list-group-item').click(function() {
        var notificationId = $(this).data('id');
        $.ajax({
            url: '/notifications/mark-read/' + notificationId,  // Adjust the URL as per your routing
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                // Update the unread count on success
                $('#notification-count').text(response.unreadCount);

                // Optionally, you can fade out the notification item smoothly
                $(this).fadeOut();  // Fades out the clicked notification item
                
                // Optionally, you can close the modal after marking as read
                $('#notification-modal').fadeOut();
            }
        });
    });


    // Mark all notifications as read
    $('#mark-all-read').click(function() {
        $.ajax({
            url: '/notifications/mark-all-read',  // Adjust this URL to the proper route
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                // Update the unread count to 0
                $('#notification-count').text(0);

                // Clear the notification list from the modal
                $('.list-group').empty();  // This will remove all notifications from the list

                // Optionally, you can display a message saying all notifications are marked as read
                $('.modal-body').html('<div class="alert alert-info">All notifications marked as read.</div>');
            }
        });
    });

});

</script>
