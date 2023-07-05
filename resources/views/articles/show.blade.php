@extends('layouts.app')

@section('title')
    Détails {{ $article->name }} - Laravel Online Store
@endsection
@section('content')


    <div class="container mt-4">

        <div class="row justify-content-center">
            <div class="col-md-7">
                <h1 class='pb-3 text-center'>{{ $article->nom }}</h1>
                <img class="card-img-top mb-3" src="{{ asset("images/$article->image") }}" alt="article">
            </div>

            <div class="col-md-5 mt-5">
                <div class="card text-center p-3 m-3\">
                        <div class="card-body">
                    <h2 class="card-text font-weight-bold font-italic text-info">{{ $article->description }}</h2>
                    <p class="card-text font-italic">{{ $article->description_detaillee }}</p>
                    <i class="fas fa-box-open fa-2x mr-2"></i>@php DisplayStock($article->stock) @endphp

                    @php $campagne = getCampaign($article->id) @endphp

                    @if ($campagne)
                        <p class="card-text text-danger font-weight-bold">{{ $campagne->nom }} :
                            -{{ $campagne->reduction }}%</p>
                        <h3 class="card-text font-weight-light"><del>{{ $article->prix }} €</del>
                            <span class="text-danger font-weight-bold">
                                @php
                                    $newPrice = $article->prix - $article->prix * ($campagne->reduction / 100);
                                    echo number_format($newPrice, 2) 
                                @endphp €</span>
                        </h3>
                    @else
                        <h3 class="card-text font-weight-light">@php number_format($article->prix, 2) @endphp €</h3>
                    @endif

                    @php $articleId = $article->id @endphp

                    @if (auth()->user() !== null)
                        @if (Auth::user()->isInFavorites($article))
                            <!-- si dans les favoris-->
                            <form method="post" action="{{ route('favoris.destroy') }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-warning m-2">Retirer des favoris</button>
                                <input type="hidden" value="{{ $article->id }}" name="articleId">
                            </form>
                        @else
                            <!-- si pas dans les favoris-->
                            <form method="post" action="{{ route('favoris.store') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary text-light m-2">Ajouter aux
                                    favoris</button>
                                <input type="hidden" value="{{ $article->id }}" name="articleId">
                            </form>
                        @endif
                    @endif

                    @if ($article->stock > 0)
                        <form method="POST" action="{{ route('cart.add', $article) }}" class="form-inline d-inline-block">
                            @csrf
                            <input type="number" min="1" max="9" name="quantite" value="1"
                                class="form-control mr-2">
                            <button type="submit" class="btn btn-danger">+ Ajouter au panier</button>
                        </form>
                    @endif

                    <h5 class="p-4">Note et avis sur ce produit</h5>
                    <div class="container w-75 m-auto">

                        <div class="row pb-2 justify-content-center text-warning">
                            <i class="fas fa-star fa-2x mr-4 text-warning"></i>
                            <h4>{{ $article->note }} / 5</h4>
                        </div>

                        @php $avisNumber = count($article->avis) @endphp

                        @if (isset($avisNumber) && $avisNumber > 0)
                            @foreach ($article->avis as $avis)
                                <div class="row justify-content-around text-info">
                                    <p>Posté par {{ $avis->user->pseudo }}</p>
                                    <p>{{ \Carbon\Carbon::parse($avis->created_at)->diffForHumans() }}</p>
                                </div>
                                <div class="row justify-content-center">
                                    <p><b>{{ $avis->note }} / 5</b></p>
                                </div>
                                <?php $commentaire = $avis->commentaire; ?>
                                @if ($commentaire !== null)
                                    <p>{{ $avis->commentaire }}</p>
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
                                <input required type="number" class="form-control" name="note" id="note"
                                    min="1" max="5">
                            </div>
                            <div class="form-group">
                                <label for="commentaire">Commentaire (facultatif)</label>
                                <textarea type="textarea" class="form-control" name="commentaire" rows="4" cols="33" id="commentaire"
                                    placeholder="Un super produit, etc"></textarea>
                            </div>
                            <input type="hidden" name="articleId" value="{{ $article->id }}">
                            <button type="submit" class="btn btn-warning">Envoyer</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
