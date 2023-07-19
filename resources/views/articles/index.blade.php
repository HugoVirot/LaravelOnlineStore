@extends('layouts.app')

@section('title')
    Catalogue - Laravel Online Store
@endsection

@section('content')
    <h1 class='pb-5 text-center'>Catalogue</h1>

    <div class="container">
        <div class="row">

            @foreach ($articles as $article)
                @include('cardarticle')
            @endforeach

        </div>
    </div>
@endsection
