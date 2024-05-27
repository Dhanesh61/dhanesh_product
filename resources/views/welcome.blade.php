<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dk brother</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
    <style>
       body {
    font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif;
    line-height: 1.5;
    background-color: #F3F4F6;
    color: #374151;
    transition: background-color 0.3s, color 0.3s;
}

.container {
    max-width: 960px;
    margin: 0 auto;
    padding: 0 20px;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
}

nav ul li {
    margin-right: 20px;
}

nav ul li:last-child {
    margin-right: 0;
}

nav ul li a {
    color: #374151;
    text-decoration: none;
    transition: color 0.3s;
}

nav ul li a:hover {
    color: #FF2D20;
}

/* Style for login and register buttons */
.login-btn,
.register-btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s; 
}

.login-btn {
    background-color: #4CAF50;
    color: white;
}

.login-btn:hover {
    background-color: #45a049;
    color: white; 
}

.register-btn {
    background-color: #3498db;
    color: white;
}

.register-btn:hover {
    background-color: #2980b9;
    color: white; 
}

/* Style for DK Brothers heading */
h1#dk-brothers {
    font-size: 3em;
    color: #333;
    text-align: center;
    margin-top: 50px;
    /* Additional styles */
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 2px;
}

/* Style for homepage image */
.homepage-image {
    display: block;
    margin: 50px auto;
    max-width: 100%;
    height: auto;
}

    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1 id="dk-brothers">DK Brothers</h1>
            <nav>
                <ul>
                    @if (Route::has('login'))
                        @auth
                            <li><a href="{{ route('login') }}">Dashboard</a></li>
                            {{-- <li><a href="{{ url('/dashboards') }}">Dashboard</a></li> --}}
                        @else
                            <li><a href="{{ route('login') }}" class="login-btn">Log in</a></li>
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}" class="register-btn">Register</a></li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </nav>
        </header>
        <!-- Homepage image from Unsplash -->
        <img src="https://source.unsplash.com/random/800x400" alt="Homepage Image" class="homepage-image">
    </div>
</body>
</html>