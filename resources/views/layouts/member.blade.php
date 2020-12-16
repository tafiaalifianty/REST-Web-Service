<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('me') }}">{{ __('Me') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('member') }}">{{ __('Get Member') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order') }}">{{ __('Create Order') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orderget') }}">{{ __('Get Order') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('payment') }}">{{ __('Payment') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tiketid') }}">{{ __('Ticket by ID') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tiketuser') }}">{{ __('Ticket by User ID') }}</a>
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Logout
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); log()">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js')
    <script>
        $('#navbarDropdown').text(localStorage.getItem('nama'));

        if(!localStorage.getItem('token')){
            window.location.href = '/login';
        }

        function log(){
            $.ajax({
                url: "/api/v1/auth/logout",
                type:"POST",
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
                },
                success:function(response){
                    localStorage.clear();
                    window.location.href = '/login';
                },
            });
        }
    </script>
</body>
</html>
