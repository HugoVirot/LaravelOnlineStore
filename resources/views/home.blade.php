@extends('layouts.app')

@section('title')
    Laravel Online Store
@endsection

@section('content')

    <!-- si je suis connecté-->
    @if (session())
        <!-- si la route précédente était login, donc si je viens de me connecter -->
        @if (session()->get('_previous') && str_contains(session()->get('_previous')['url'], 'login'))
            <p class="w-75 mx-auto text-center alert alert-success">Vous êtes connecté</p>
        @endif
    @endif

    <div class="container-fluid text-center d-flex align-items-center" id="imageAccueil">
        <div class="row">
            <h1 id="titreAccueil">Laravel Online Store</h1>
            <p id="paragrapheAccueil" class="text-white fs-3">votre site high-tech de référence</p>
        </div>
    </div>

    @if ($currentPromo)
        <div class="container text-center pt-5 mb-3">
            <div class="col justify-content-center">
                <p class="fs-4" id="promoDuMoment">promotion du moment</p>
                <h2 class="currentPromoTitle">{{ $currentPromo->nom }}</h2>
                <h3 class="text-primary fs-2">-{{ $currentPromo->reduction }}% sur une sélection d'articles</h3>
                <h3>du {{ date('d/m', strtotime($currentPromo->date_debut)) }} au
                    {{ date('d/m/y', strtotime($currentPromo->date_fin)) }}</h3>
            </div>
            <div class="row mt-5 mb-5">
                @php $campagne = $currentPromo @endphp
                @foreach ($currentPromo->articles as $article)
                    @include('cardarticle')
                @endforeach
                <div class="container text-center pt-4">
                    <a href="{{ route('campagnes.index') }}">
                        <button class="btn btn-lg btn-warning">Voir toutes les promotions</button>
                    </a>
                </div>

            </div>
        </div>
    @endif

    <div class="container text-center text-light bg-primary p-5 mt-5">
        <div class="row justify-content-center">
            <i class="fas fa-star fa-3x mr-4"></i>
            <h2>Produits les mieux notés</h2>
        </div>

        <div class="row mt-5">

            @foreach ($topRatedArticles as $article)
                @include('cardtoparticle')
            @endforeach

            <div class="container text-center pt-4">
                <a href="{{ route('articles.index') }}">
                    <button class="btn btn-lg btn-warning">Voir tout le catalogue</button>
                </a>
            </div>
        </div>
    </div>

@endsection
