@extends('layouts.app')

@section('title')
    Gammes - Laravel Online Store
@endsection


@section('content')
    <div class="container-fluid text-center mb-4">
        <img class="w-75 border border-primary" src="{{ asset('images/ranges.jpg') }}" alt="gammes">
    </div>

    <h1 class='pb-5 text-center'>Nos gammes</h1>

    <div class="container ranges">
        <div class="row">

            @foreach ($gammes as $gamme)
                <div class="container p-5 border border-info">
                    <div class="row p-5 text-center">
                        <h2 class="text-primary fs-1">{{ $gamme->nom }}</h2>
                    </div>
                    <div class="container">
                        <div class="row">

                            @foreach ($gamme->articles as $article)
                                @include('cardarticle')
                            @endforeach

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
