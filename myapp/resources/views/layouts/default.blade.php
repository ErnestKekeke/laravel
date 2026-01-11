<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/reset.css')
    @vite('resources/css/home.css') --}}
    @include('layouts.meta')
</head>
<body>

    <header>
        <h2>This is a @yield('page-name') Page</h2>
    </header>

    <main>
        <h2>Hello from Ktek</h2>
        @yield('main-content')
    </main>

    <footer>
        @yield('footer')
    </footer>
    
</body>
</html>