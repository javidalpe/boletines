<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.meta')
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="google-site-verification" content="gUmuzUFcJ_5nbSlsYKiBLR_hVBe1h4htYqlUDAKRy4E" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
@include('layouts.navbar')
<div class="container">
    @include('flash::message')
</div>
@yield('content')
@include('landing.footer')
@include('layouts.scripts')
@stack('scripts')
</body>
</html>
