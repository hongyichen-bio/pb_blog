<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    @include('layouts.meta')
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
    @include('layouts.nav')
    <div class="container">
        @yield('content')
    </div>
    @include('layouts.footer')
    <!-- <script src="{{ mix('/js/app.js') }}"></script> -->
</body>
</html>