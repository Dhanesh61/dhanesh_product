<!-- resources/views/profile/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            padding: 20px;
            display: flex;
            justify-content: center; /* Center the profile container horizontally */
            align-items: center; /* Center the profile container vertically */
            height: 100vh; /* Set height to viewport height for vertical centering */
        }
        .profile-container {
            width: 500px; /* Adjust the width of the profile container */
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(220, 8, 8, 0.1); /* Add box-shadow effect */
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1 class="mb-4"><u><center>Your Profile</center></u></h1>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Name:</strong> {{ $user->name }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>
        </div>
        
        <!-- Link back to home page -->
        <div class="mt-4">
            <a href="{{ route('home')}}" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
</body>
</html>
