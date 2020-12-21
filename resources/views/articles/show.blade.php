@extends('layouts.app')

@section('title')
Détails {{$article->name}} - Laravel Online Store
@endsection
@section('content')

<h2 class='pb-5 text-center'>Détails {{ $article->nom }}</h3>

    <div class="container">
        <div class="row justify-content-center">

            <div class="card text-center col-md-6 p-3 m-3\" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset("images/$article->image") }}" alt="article">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">{{$article->nom}}</h5>
                    <p class="card-text font-italic">{{$article->description}}</p>
                    <p class="card-text font-italic">{{$article->description_detaillee}}</p>
                    <p class="card-text font-weight-light">{{$article->prix}}€</p>

                    <form method="POST" action="{{ route('basket.add', $article) }}" class="form-inline d-inline-block">
                        @csrf
                        <input type="number" name="quantite" placeholder="Quantité ?" class="form-control mr-2">
                        <button type="submit" class="btn btn-warning">+ Ajouter au panier</button>
                    </form>

                    <h5 class="p-4">Avis sur ce produit</h5>
                    <div class="container w-50 m-auto">
                        @php $avisNumber = count($article->avis);
                        @endphp

                        @if ($avisNumber > 0)

                        @foreach($article->avis as $avis)
                        <div class="row justify-content-around text-info">
                            <p>Posté par {{$avis->user_id}}</p>
                            <p>{{ \Carbon\Carbon::parse($avis->created_at)->diffForHumans() }}</p>
                        </div>
                        <div class="row justify-content-center">
                            <p><b>{{$avis->note}} / 5</b></p>
                        </div>
                        @php $commentaire = $avis->commentaire
                        @endphp
                        @if($commentaire !== null)
                        <p>{{$avis->commentaire}}</p>
                        @endif
                        <hr>
                        @endforeach

                        @else
                        <p>Aucun avis posté.</p>

                        @endif
                    </div>
                    <div class="container border border-info p-2 mt-3 mb-3">
                        <h5 class="p-4">Vous l'avez testé ? Notez ce produit !</h5>
                        <form method="post" action="{{ route('avis.store') }}" class="w-50 m-auto">
                            @csrf
                            <div class="form-group">
                                <label for="note">Note sur 5</label>
                                <input required type="number" class="form-control" name="note" id="note" min="1" max="5">
                            </div>
                            <div class="form-group">
                                <label for="commentaire">Commentaire (facultatif)</label>
                                <textarea type="textarea" class="form-control" name="commentaire" rows="4" cols="33" id="commentaire">Un super produit, etc</textarea>
                            </div>
                            <input type="hidden" name="articleId" value="{{$article->id}}">
                            <button type="submit" class="btn btn-warning">Envoyer</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>

    @endsection