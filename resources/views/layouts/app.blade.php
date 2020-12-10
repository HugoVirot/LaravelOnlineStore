<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="icon" href="{{ asset("images/logo.png") }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css">
</head>

<body>
    <div id="app">
        <div class="container text-center mt-4">
            <img style="width : 100px;" src="{{ asset("images/logo.png") }}" alt="logo">
            <h2 class="pt-3">Laravel Online Store</h2>
        </div>
        <nav class="navbar navbar-expand-md pb-3 navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand pr-5" href="{{ url('/') }}">
                    <i class="fas fa-home"></i>
                </a>
                <a class="navbar-brand pr-5" href="{{ route('articles.index') }}">
                    Catalogue
                </a>
                <a class="navbar-brand pr-5" href="{{ route('gammes.index') }}">
                    Gammes
                </a>
                <a class="navbar-brand pr-5" href="{{ route('gammes.index') }}">
                    Lien 3
                </a>
                <a class="navbar-brand pr-5" href="{{ route('gammes.index') }}">
                    Lien 4
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color: black" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ auth()->user()->pseudo }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('account', $user = auth()->user()->id) }}">{{ __('Mon compte') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Déconnexion') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container w-50 text-center p-3">

            @if(session()->has('message'))
            <p class="alert alert-success">{{ session()->get('message') }}</p>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<footer class="text-center bg-info p-5 mt-5">
    <p>© LaravelOnlineStore 2020</p>
</footer>

</html>