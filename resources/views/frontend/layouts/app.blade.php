<!doctype html>
<html dir="{{ config('web_settings.dir','ltr') }}" lang="{{ config('web_settings.lang','en') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('web_settings.page_description_' . $pageName , 'Expo') }}">
    <meta name="keywords" content="{{ config('web_settings.page_keywords_' . $pageName , 'Expo') }}">
    <meta name="author" content="{{ config('web_settings.page_author_' . $pageName , 'Expo') }}">
    <!-- Title -->
    <title>{{ ucfirst(config('settings.app_name','Expo')) . ' | ' .config('web_settings.page_title_' . $pageName , 'Home Page') }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset(config('settings.favicon')) }}" type="image/png" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    {{ mb::GoogleFont('Poppins','300;400;500;600;700') }}
    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('settings.app_name','Expo') }}
                </a>
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                        @else
                        <li class="nav-item mx-3 my-2">
                            {{ Auth::user()->name }}
                        </li>
                        <li class="nav-item  my-2">
                            <a class="" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>


    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}" defer></script>
</body>
</html>
