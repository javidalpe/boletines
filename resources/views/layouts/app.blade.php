<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
       @include('layouts.meta')
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @stack('styles')
    </head>
    <body>
        @include('layouts.navbar')
        <div class="container">
            @include('flash::message')
            @yield('content')
        </div>
        @include('dashboard.footer')
        @stack('scripts')
    </body>
</html>
