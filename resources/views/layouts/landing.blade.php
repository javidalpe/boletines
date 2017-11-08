<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.meta')
        <title>{{ config('app.name', 'Laravel') }}</title>
        @include('layouts.styles')
        @stack('styles')
    </head>
    <body>
    @include('layouts.tag-manager-noscript')
        @include('layouts.navbar')
        <div class="container">
            @include('flash::message')
        </div>
        @yield('content')
        @include('landing.footer')
        @include('layouts.scripts')
        @include('cookieConsent::index')
        @stack('scripts')
    </body>
</html>
