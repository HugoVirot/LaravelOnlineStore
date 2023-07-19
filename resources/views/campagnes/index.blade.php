@extends('layouts.app')

@section('title')
    Promotions - Laravel Online Store
@endsection


@section('content')
    <h2 class='pb-5 text-center'>Promotions</h3>

        <div class="container">
            <div class="row">

                @foreach ($campagnes as $campagne)
                    <div class="container p-5 text-center border border-info">
                        <div class="row p-2">
                            <h1 class="currentPromoTitle">{{ $campagne->nom }}</h1>
                        </div>
                        <div class="row p-2 justify-content-center">
                            <h4>du {{ date('d/m', strtotime($campagne->date_debut)) }} au
                                {{ date('d/m/y', strtotime($campagne->date_fin)) }}</h4>
                        </div>
                        <div class="row p-3 justify-content-center text-primary">
                            <h2>-{{ $campagne->reduction }} % sur tous ces produits</h2>
                        </div>
                        <div class="container">
                            <div class="row">

                                @foreach ($campagne->articles as $article)
                                    @include('cardpromoarticle')
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endforeach
            @endsection
