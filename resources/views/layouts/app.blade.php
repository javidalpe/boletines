<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.meta')
        <title>{{ config('app.name', 'Laravel') }}</title>
        @include('layouts.styles')
        @yield('seo')
        @stack('styles')
    </head>
    <body>
        @include('layouts.tag-manager-noscript')
        @include('layouts.navbar')
        <div class="container">
            @include('flash::message')
            @yield('content')
        </div>
        @include('dashboard.footer')
        @stack('scripts')
    </body>
</html>
