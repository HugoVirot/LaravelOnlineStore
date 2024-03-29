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

    <link rel="icon" href="{{ asset('images/logo.png') }}">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css"> --}}
    <script src="https://kit.fontawesome.com/6259f9b52f.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="/tarteaucitron/tarteaucitron.js"></script>

    <script type="text/javascript">
        tarteaucitron.init({
            "privacyUrl": "",
            /* Privacy policy url */

            "hashtag": "#tarteaucitron",
            /* Open the panel with this hashtag */
            "cookieName": "tarteaucitron",
            /* Cookie name */

            "orientation": "middle",
            /* Banner position (top - bottom) */

            "groupServices": false,
            /* Group services by category */

            "showAlertSmall": false,
            /* Show the small banner on bottom right */
            "cookieslist": false,
            /* Show the cookie list */

            "closePopup": false,
            /* Show a close X on the banner */

            "showIcon": true,
            /* Show cookie icon to manage cookies */
            //"iconSrc": "", /* Optionnal: URL or base64 encoded image */
            "iconPosition": "BottomRight",
            /* BottomRight, BottomLeft, TopRight and TopLeft */

            "adblocker": false,
            /* Show a Warning if an adblocker is detected */

            "DenyAllCta": true,
            /* Show the deny all button */
            "AcceptAllCta": true,
            /* Show the accept all button when highPrivacy on */
            "highPrivacy": true,
            /* HIGHLY RECOMMANDED Disable auto consent */

            "handleBrowserDNTRequest": false,
            /* If Do Not Track == 1, disallow all */

            "removeCredit": false,
            /* Remove credit link */
            "moreInfoLink": true,
            /* Show more info link */

            "useExternalCss": false,
            /* If false, the tarteaucitron.css file will be loaded */
            "useExternalJs": false,
            /* If false, the tarteaucitron.js file will be loaded */

            //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for multisite */

            "readmoreLink": "",
            /* Change the default readmore link */

            "mandatory": true,
            /* Show a message about mandatory cookies */
        });
    </script>
</head>

<body>
    <div id="app">
        <div class="container-fluid text-center p-4" id="header">
            <img style="width : 100px;" src="{{ asset('images/logo.png') }}" alt="logo">
            <h1 class="pt-3" id="titreNavbar">Laravel Online Store</h1>
        </div>
        <nav class="navbar navbar-expand-md sticky-top p-4 navbar-dark shadow-sm">
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
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
                            <a class="navbar-brand" href="{{ route('cart.show') }}">
                                Panier
                            </a>
                        </li>
                        @if (auth()->user())
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color: white" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ auth()->user()->pseudo }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                        href="{{ route('account', $user = auth()->user()->id) }}">{{ __('Mon compte') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Déconnexion') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    <!-- affichage du lien back-office uniquement pour l'administrateur -->
                                    @if(Auth::user()->isAdmin())
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

            @if (session()->has('message'))
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

</body>

</html>
