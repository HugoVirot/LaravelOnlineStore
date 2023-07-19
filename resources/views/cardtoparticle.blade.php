<div class="card text-center text-dark col-md-4 p-3 m-3\">
    <img class="card-img-top"
    src="{{ asset("images/$article->image") }}" alt="article">
    <div class="card-body">
        <h3 class="card-title fw-bold">#{{ $loop->iteration }}</h3>
        <div class="row justify-content-center align-middle">
            <i class="text-warning fas fa-star mr-2 fa-2x"></i>
            <span class="card-title fw-bold fs-3 text-warning">Note : {{ $article->note }} / 5</span>
        </div>
        <h5 class="card-title fw-bold">{{ $article->nom }}</h5>
        <p class="card-text font-italic">{{ $article->description }}</p>

        @php $campagne = GetCampaign($article->id) @endphp

        @if ($campagne)
            <p class="card-text text-danger fw-bold">{{ $campagne->nom }} :
                -{{ $campagne->reduction }}%</p>
            <h5 class="card-text font-weight-light"><del>{{ $article->prix }} €</del>
                <span class="text-danger fw-bold">
                    @php
                        $newPrice = $article->prix - $article->prix * ($campagne->reduction / 100);
                        echo number_format($newPrice, 2);
                    @endphp
                    €</span>
            </h5>
        @else
            <h5 class="card-text fw-bold">{{ $article->prix }} €</h5>
        @endif


        <a href="{{ route('articles.show', $article) }}">
            <button class="btn btn-info m-2">Détails produit</button>
        </a>


        @php $articleId = $article->id @endphp

        @if (auth()->user() !== null)
            @if (Auth::user()->isInFavorites($article))
                <!-- si dans les favoris-->
                <form method="post" action="{{ route('favoris.destroy', $article->id) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger m-2">Retirer des favoris</button>
                </form>
            @else
                <!-- si pas dans les favoris-->
                <form method="post" action="{{ route('favoris.store') }}">
                    @csrf
                    <input type="hidden" value="{{ $article->id }}" name="articleId">
                    <button type="submit" class="btn btn-success m-2">Ajouter aux favoris</button>
                </form>
            @endif
        @endif

        @if ($article->stock > 0)
            <form method="POST" action="{{ route('cart.add', $article->id) }}" class="form-inline d-inline-block">
                @csrf
                <input type="number" min="1" max="9" name="quantite" class="form-control mr-2"
                    value="{{ isset(session('cart')[$article->id]) ? session('cart')[$article->id]['quantite'] : 1 }}">
                <button type="submit" class="btn btn-warning mt-2">+ Ajouter au panier</button>
            </form>
        @endif

    </div>
</div>
