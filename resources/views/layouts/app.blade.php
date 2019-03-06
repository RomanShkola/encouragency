<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_TITLE')}}</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/cover.css')}}">

    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>
</head>
<body>
<div id="app">
@include('inc.navbar')

    @yield('content')

    @include('inc.footer')
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
