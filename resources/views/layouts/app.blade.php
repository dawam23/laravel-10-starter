<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

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

            <x-page-header :title="$title ?? ''" :pretitle="$pretitle ?? ''" :actions="$actions ?? ''"
                :subtitle="$subtitle ?? ''" />

            <div class="page-body">
                {{ $slot }}
            </div>
            @include('layouts.partials.footer')

        </div>

    </div>
    <!-- Libs JS -->

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{ $scripts ?? '' }}
    @include('layouts.config.toastrjs')

    {{-- datatables custom css --}}
    <script>
        $('div.dataTables_length').addClass('ps-lg-4');
            $('div.dataTables_filter').addClass('pe-lg-4');
            $('div.dataTables_info').addClass('ps-lg-4');
            $('div.dataTables_paginate').addClass('pe-lg-4');
    </script>
</body>

</html>
