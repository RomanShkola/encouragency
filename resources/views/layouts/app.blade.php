<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('APP_TITLE')}}</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/cover.css')}}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</head>
<body>
@include('inc.navbar')



@yield('carousel')

<div class="container marketing">
    @yield('section-features')
    @yield('section-important')
</div>

<div class="container">
@yield('content')
</div>
<div class="container">
    @yield('section-contact')
</div>

@include('inc.footer')

</body>
</html>
