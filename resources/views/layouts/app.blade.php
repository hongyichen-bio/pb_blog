<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    @include('layouts.meta')
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    @include('layouts.nav')
    <div class="container">
        @yield('content')
    </div>
    @include('layouts.footer')
    @include('layouts.js')
</body>
</html>