
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ asset('favicon.svg') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite('resources/sass/app.scss')

        {{ $styles ?? '' }}

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
        <!-- Navbar -->
            <div class="sticky-top">
                @include('layouts.partials.header')
                @include('layouts.partials.navigation')
            </div>

            <div class="page-wrapper">

                <x-page-header
                    :title="$title ?? ''"
                    :pretitle="$pretitle ?? ''"
                    :actions="$actions ?? ''"
                    :subtitle="$subtitle ?? ''" />

                <div class="page-body">
                    {{ $slot }}
                </div>
                @include('layouts.partials.footer')

            </div>

        </div>
        <!-- Libs JS -->
        <script src="{{ asset('build/assets/app.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
        {{ $scripts ?? '' }}
    </body>
</html>
