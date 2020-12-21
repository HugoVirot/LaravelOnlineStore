@extends('layouts.app')

@section('title')
Modifier gamme {{$gamme->nom}}
@endsection

@section('content')

<div class="container w-50 text-center">
    <form method="post" action="{{route('gammes.update', $gamme)}}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="nom">nom</label>
            <input required type="text" class="form-control" name="nom" value="{{$gamme->nom}}" id="nom">
        </div>
        <button type="submit" class="btn btn-info text-light mt-4">Valider</button>
    </form>
</div>

@endsection