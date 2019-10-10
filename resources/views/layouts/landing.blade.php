<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.meta')

        @include('layouts.styles')
        @yield('seo')
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
        @include('cookieConsent::index')
        @include('layouts.defer-styles')
        @stack('scripts')
        @include('layouts.scripts')
    </body>
</html>
