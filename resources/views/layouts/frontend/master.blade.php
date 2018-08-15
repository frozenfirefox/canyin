<!DOCTYPE html>
<html lang="en-gb">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')@yield('sitename')</title>

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="{{ asset('asset_admin/assets/plugins/jquery/jquery-1.9.1.min.js') }}"></script>

    </head>

    @include('layouts.frontend.navbar')

    <body>
        <div class="container">
            <div class="row">
                @include('layouts.flash')
                @yield('body')
            </div>
        </div>

    </body>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    @yield('js_my')
</html>
