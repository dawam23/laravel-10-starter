<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

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

<body class=" border-top-wide border-primary d-flex flex-column">
    <script src="{{ asset('js/initTheme.min.js') }}"></script>
    <div class="page page-center">
        <div class="empty">
            <div class="empty-header">
                @yield('code')
            </div>
            <p class="empty-title">@yield('message')</p>
            <p class="empty-subtitle text-muted">
                @yield('sub message')
            </p>
            <div class="empty-action">
                <a href="./." class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l14 0" />
                        <path d="M5 12l6 6" />
                        <path d="M5 12l6 -6" />
                    </svg>
                    {{ __('Take me home') }}
                </a>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    @stack('scripts')
</body>

</html>
