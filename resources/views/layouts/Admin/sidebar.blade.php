<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
    body {
        display: flex;
    }
    .sidebar {
        width: 250px;
        background-color: #343a40;
        height: 100vh;
        padding-top: 20px;
    }
    .sidebar a {
        color: white;
        text-decoration: none;
        padding: 15px;
        display: block;
    }
    .sidebar a:hover {
        background-color: #495057;
    }
    .main-content {
        flex-grow: 1;
        padding: 20px;
    }
</style>
</head>
<body>

<div class="sidebar">
    <h3 class="text-white text-center">Dashboard</h3>
    <a href="">Dashboard</a>
    <a href="">Users</a>
    <a href="">Businesses</a>
    <a href="">Roles</a>
    <a href="">Settings</a>
    <a href="">Logout</a>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
