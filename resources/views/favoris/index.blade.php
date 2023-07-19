@extends('layouts.app')

@section('title')
    Favoris - Laravel Online Store
@endsection


@section('content')

    <h1 class='pb-5 text-center'>Mes favoris</h1>

        <div class="container">
            <div class="row">

                @if (count($user->favoris) > 0)
                    @foreach ($user->favoris as $article)
                        @include('cardarticle')
                    @endforeach
                @else
                    <div class="container text-center">
                        <h5 class="text-center p-5 m-5">Vous n'avez aucun article dans vos favoris.</h5>
                    </div>
                @endif
            @endsection
