<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DK -@yield('title','website')</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="wrapper">
        <header><h1>Dhanesh</h1></header>
        <nav>
            <a href="/">Admin</a>
         
            
        </nav>
        <main>
            <article>
               @yield('content')
            </article>
        </main>
    </div>
</body>
</html>