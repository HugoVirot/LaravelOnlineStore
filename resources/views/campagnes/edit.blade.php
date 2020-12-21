@extends('layouts.app')

@section('title')
Modifier campagne {{$campagne->nom}}
@endsection

@section('content')

<div class="container w-50 text-center">
    <form method="post" action="{{route('campagnes.update', $campagne)}}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="nom">nom</label>
            <input required type="text" class="form-control" name="nom" value="{{$campagne->nom}}" id="nom">
        </div>
        <div class="form-group">
            <label for="reduction">réduction en %</label>
            <input required type="text" class="form-control" name="reduction" value="{{$campagne->reduction}}" id="noreductionm">
        </div>
        <div class="form-group">
            <label for="date_debut">date de début</label>
            <input required type="text" class="form-control" name="date_debut" value="{{$campagne->date_debut}}" id="date_debut">
        </div>
        <div class="form-group">
            <label for="date_fin">date de fin</label>
            <input required type="text" class="form-control" name="date_fin" value="{{$campagne->date_fin}}" id="date_fin">
        </div>
        <div class="form-group">
            @foreach ($articles as $article)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" 
                class="custom-control-input" name="article{{ $article->id }}"
                value="{{ $article->id }}" id="article{{ $article->id }}"
                @foreach ($campagneArticlesIds as $id) 
                @if ($article->id == $id->article_id)
                checked="checked"
                @break
                @endIf
                @endforeach>
                <label class="custom-control-label" for="article{{ $article->id }}">{{ $article->nom }}</label>
            </div>
            @endforeach
            <!-- @foreach ($articles as $article)
            <input type="checkbox" id="article{{$article->id}}" name="article{{$article->id}}" value="{{$article->id}}" checked>
            <label for="article{{$article->id}}">{{$article->nom}}</label>
            @endforeach -->
        </div>
        <button type="submit" class="btn btn-info text-light mt-4">Valider</button>
    </form>
</div>

@endsection