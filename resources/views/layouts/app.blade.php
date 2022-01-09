<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    @include('layouts.meta')
    @include('layouts.css')
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