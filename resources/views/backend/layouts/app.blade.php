<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('settings.app_name', 'expo') }}</title>

    <!-- Fonts -->
    {{ mb::GoogleFont('Poppins','300;400;500;600;700') }}

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/expo.css') }}" rel="stylesheet">
    @yield('page_style')
    @livewireStyles
</head>
<body id="body-pd" class="{{ config('settings.sidebar_visibility') == 'visible' ? 'body-pd' : '' }}">

    <livewire:layouts.navbar />
    <livewire:layouts.sidebar />

    <!--Container Main start-->
    <div class="mx-4 mt-5">
        @yield('content')
        {{ $slot }}
    </div>
    <!--Container Main end-->
    <livewire:layouts.side-profile />
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/expo.js') }}" defer></script>
    @livewireScripts
    @yield('page_script')
</body>
</html>
