<!doctype html>
<html>
    <head>
        @include('includes.head')
        <style type="text/css">
            body {
              padding-top: 20px;
              padding-bottom: 20px;
            }

            .navbar {
              margin-bottom: 20px;
            }
            @yield('css')
        </style>
        @yield('head')
    </head>
    <body>
        @include('includes.header')
        <div class="container">
            @yield('content')
        </div>
        <footer>
            @include('includes.footer')
        </footer>
    </body>
</html>