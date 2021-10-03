<!-- 
    Named with .blade.php extension because laravel 
    ships with its own template engine which is called blade 
-->
<!-- 
    Everytime you name a file with the .blade.php extension 
    laravel treats it as a blade file for which you can use the blade syntax within 
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Github API</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!--asset is a laravel helper function, which maps up what has been put in to the base path-->
    </head>
    <body class="bg-gray-300">
        <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
                <li>
                    <a href="/" class="p-3">Home</a>
                </li>
                <li>
                    <a href="{{ route('search') }}" class="p-3">Search</a>
                </li>
            </ul>
        </nav>
        <!-- We want to extend the base layout, we want to inject the content into here, to do that we use yield -->
        @yield('content')
    </body>
</html>