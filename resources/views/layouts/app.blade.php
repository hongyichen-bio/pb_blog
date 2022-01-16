<html>
    <head>
        <title>進度條 Laravel Controller 章節</title>
        @include('layouts.meta')
        @include('layouts.css')
    </head>
    <body>
        @include('layouts.nav')
        @yield('content')
        @include('layouts.footer')
        @include('layouts.js')

        @section('inline_js')
        @show
    </body>
</html>
