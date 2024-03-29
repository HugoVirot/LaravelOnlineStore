@extends('layouts.app')

@section('title')
Modifier article {{$article->nom}}
@endsection

@section('content')

<div class="container w-50 text-center">
    <form method="post" action="{{route('articles.update', $article)}}" id="articleEditForm">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="nom">nom</label>
            <input required type="text" class="form-control" name="nom" value="{{$article->nom}}" id="nom">
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <input required type="text" class="form-control" name="description" value="{{$article->description}}" id="description">
        </div>
        <div class="form-group">
            <label for="description_detaillee">description détaillée</label>
            <textarea required class="form-control" name="description_detaillee" id="description_detaillee">{{$article->description_detaillee}}</textarea>
        </div>
        <div class="form-group">
            <label for="image">image</label>
            <input required type="text" class="form-control" name="image" value="{{$article->image}}" id="image">
        </div>
        <div class="form-group">
            <label for="prix">prix</label>
            <input required type="text" class="form-control" name="prix" value="{{$article->prix}}" id="prix">
        </div>
        <div class="form-group">
            <label for="stock">stock</label>
            <input required type="text" class="form-control" name="stock" value="{{$article->stock}}" id="stock">
        </div>
        <div class="form-group">
            <label for="note">note</label>
            <input required type="text" class="form-control" name="note" value="{{$article->note}}" id="note">
        </div>
        <div class="form-group">
            <label for="gamme_id">gamme</label>
            <select name="gamme_id" id="gamme_id">
                <option value="">--Choisissez une gamme--</option>
                @foreach ($gammes as $gamme)
                    <option value="{{ $gamme->id }}">{{ $gamme->nom }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="gamme_id" value="{{$article->gamme_id}}">
        <button type="submit" class="btn btn-info text-light mt-4">Valider</button>
    </form>
</div>

@endsection