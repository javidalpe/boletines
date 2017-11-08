<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.meta')
        <title>{{ config('app.name', 'Laravel') }}</title>
        @include('layouts.styles')
        @stack('styles')
        @include('layouts.analytics')
    </head>
    <body>
        @include('layouts.navbar')
        <div class="container">
            @include('flash::message')
            @yield('content')
        </div>
        @include('dashboard.footer')
        @include('layouts.scripts')
        @stack('scripts')
    </body>
</html>
