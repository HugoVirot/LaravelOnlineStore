<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

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
        <div class="container-fluid text-center p-4" id="header">
            <img style="width : 100px;" src="{{ asset("images/logo.png") }}" alt="logo">
            <h2 class="pt-3">Laravel Online Store</h2>
        </div>
        <nav class="navbar navbar-expand-md sticky-top p-4 navbar-dark shadow-sm">
            <div class="container">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="pl-5 collapse navbar-collapse text-center" id="navbarSupportedContent">

                    <ul class="navbar-nav w-100 justify-content-around mr-auto">
                        <li>
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a class="navbar-brand" href="{{ route('articles.index') }}">
                                Catalogue
                            </a>
                        </li>
                        <li>
                            <a class="navbar-brand" href="{{ route('gammes.index') }}">
                                Gammes
                            </a>
                        </li>
                        <li>
                            <a class="navbar-brand" href="{{ route('campagnes.index') }}">
                                Promotions
                            </a>
                        </li>
                        <li>
                            <a class="navbar-brand" href="{{ route('apropos') }}">
                                A propos
                            </a>
                        </li>
                        <li>
                            <a class="navbar-brand" href="{{ route('basket.show') }}">
                                Panier
                            </a>
                        </li>
                        @if(auth()->user() !== null)
                        <li>
                            <a class="navbar-brand" href="{{ route('favoris.index') }}">
                                Favoris
                            </a>
                        </li>
                        @endif
                        <!-- Left Side Of Navbar -->

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
                        <li class="nav-item dropdown pr-5">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color: white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                                @if (auth()->user()->role_id == 2)
                                <a class="dropdown-item" href="{{ route('admin.index') }}">
                                    Back-office
                                </a>
                                @endif
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

<footer class="text-center text-light bg-primary p-5 mt-3">
    <h5 class="m-4">© LaravelOnlineStore 2020</h5>
    <div class="container w-25 d-flex justify-content-around ">
        <a href="https://www.facebook.com" style="color:inherit">
            <i class="fab fa-3x fa-facebook-square"></i>
        </a>
        <a href="https://www.twitter.com" style="color:inherit">
            <i class="fab fa-3x fa-twitter"></i>
        </a>
        <a href="https://www.youtube.com" style="color:inherit">
            <i class="fab fa-3x fa-youtube"></i>
        </a>
    </div>
</footer>

</html>