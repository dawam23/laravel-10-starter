<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ asset('favicon.svg') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/backend/app.css', 'resources/js/backend/app.js'])

        @stack('styles')

        <style>
            @import url('https://rsms.me/inter/inter.css');
            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }
            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            }
        </style>
    </head>
    <body>
        <script src="{{ asset('js/initTheme.min.js') }}"></script>
        <div class="page">
            <div class="sticky-top">
                @include('layouts.partials.header')
                @include('layouts.partials.navigation')
            </div>
            <div class="page-wrapper">
                @yield('content')
                @include('layouts.partials.footer')
            </div>
        </div>
        <!-- Libs JS -->
        @stack('scripts')
    </body>
</html>
