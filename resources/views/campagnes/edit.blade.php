@extends('layouts.app')

@section('title')
    Modifier campagne {{ $campagne->nom }}
@endsection

@section('content')
    <div class="container text-center">
        <h1 class="p-5">Modifier la campagne {{ $campagne->nom }} </h1>
    </div>

    <div class="container w-50 text-center">
        <form method="post" action="{{ route('campagnes.update', $campagne) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="nom">nom</label>
                <input required type="text" class="form-control" name="nom" value="{{ $campagne->nom }}" id="nom">
            </div>
            <div class="form-group m-3">
                <label for="reduction">réduction en %</label>
                <input required type="text" class="form-control" name="reduction" value="{{ $campagne->reduction }}"
                    id="noreductionm">
            </div>
            <div class="form-group m-3">
                <label for="date_debut">date de début</label>
                <input required type="text" class="form-control" name="date_debut" value="{{ $campagne->date_debut }}"
                    id="date_debut">
            </div>
            <div class="form-group m-3">
                <label for="date_fin">date de fin</label>
                <input required type="text" class="form-control" name="date_fin" value="{{ $campagne->date_fin }}"
                    id="date_fin">
            </div>
            <div class="form-group m-3">
                <p class="m-3">articles associés</p>

                @foreach ($articles as $article)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="article{{ $article->id }}"
                            value="{{ $article->id }}" id="article{{ $article->id }}"
                            {{-- je vérifie si l'article est associé à la campagne --}}
                            {{-- si c'est le cas, je coche automatiquement la checkbox --}}
                            @if ($article->campagnes()->where('campagne_id', $campagne->id)->exists()) checked @endif >
                        <label class="custom-control-label" for="article{{ $article->id }}">{{ $article->nom }}</label>
                    </div>
                @endforeach

            </div>
            <button type="submit" class="btn btn-info text-light mt-4">Valider</button>
        </form>
    </div>
@endsection
