@extends("layouts.app")
@section('content')
    <div class="container">
        @if (session()->has('cart'))
            <h1>Mon panier</h1>
            <div class="table-responsive shadow mb-3">
                <table class="table table-bordered table-hover bg-white mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>description</th>
                            <th>Quantité</th>
                            <th>Total</th>
                            <th>Opérations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Initialisation du total général à 0 -->
                        @php $total = 0 @endphp

                        <!-- On parcourt les produits du panier en session : session('cart') -->
                        @foreach (session('cart') as $key => $item)
                            <!-- On incrémente le total général par le total de chaque produit du panier -->
                            @if (count($item) > 0)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <strong><a href="{{ route('articles.show', $key) }}"
                                                title="Afficher le produit">{{ $item['nom'] }}</a></strong>
                                    </td>

                                    @php $campagne = GetCampaign($item['id']) @endphp

                                    @if ($campagne)

                                        <td>
                                            <p class="card-text text-danger font-weight-bold">{{ $campagne->nom }} :
                                                -{{ $campagne->reduction }}%</p>
                                            <del>{{ $item['prix'] }} €</del>
                                            <span class="text-danger font-weight-bold">
                                                @php
                                                    $newPrice = $item['prix'] - $item['prix'] * ($campagne->reduction / 100);
                                                    echo number_format($newPrice, 2, ',', ' ');
                                                @endphp
                                                €</span>

                                        </td>
                                    @else
                                        <td>@php echo number_format($item['prix'], 2, ',', ' ') @endphp;
                                        </td>
                                    @endif

                                    <td>{{ $item['description'] }}</td>
                                    <td>
                                        <!-- Le formulaire de mise à jour de la quantité -->
                                        <form method="POST" action="{{ route('cart.add', $key) }}"
                                            class="form-inline d-inline-block">
                                            @csrf
                                            <input type="number" min="1" max="9" name="quantite"
                                                value="{{ $item['quantite'] }}" class="form-control mr-2"
                                                style="width: 80px">
                                            <input type="submit" class="btn btn-primary" value="Actualiser" />
                                        </form>
                                    </td>
                                    <td>
                                        <!-- Le total du produit = prix * quantité -->
                                        @if ($campagne)
                                            @php
                                                $lineTotal = $newPrice * $item['quantite'];
                                            @endphp
                                        @else
                                            @php
                                                $lineTotal = $item['prix'] * $item['quantite'];
                                            @endphp
                                        @endif
                                        @php
                                            echo number_format($lineTotal, 2, ',', ' ') . ' €';
                                            $total += $lineTotal;
                                        @endphp
                                    </td>
                                    <td>
                                        <!-- Le Lien pour retirer un produit du panier -->
                                        <a href="{{ route('cart.remove', $key) }}" class="btn btn-outline-danger"
                                            title="Retirer le produit du panier">Retirer</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        <tr colspan="2">
                            <td colspan="4">Total général</td>
                            <td colspan="2">
                                <!-- On affiche total général -->
                                <strong>@php echo (number_format($total, 2, ',', ' ') . " €") @endphp</strong>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="container w-50 text-center">
                <!-- Lien pour vider le panier -->
                <a class="btn btn-danger" href="{{ route('cart.empty') }}"
                    title="Retirer tous les produits du panier">Vider le panier</a>

                @if (Auth::check())
                    <!-- Lien pour valider le panier -->
                    <a class="btn btn-primary" href="{{ route('cart.validation') }}" title="validation">Valider la
                        commande</a>
                @else
                    <p class="p-2">Vous devez être connecté pour valider la commande.</p>
                @endif

            @else
                <div class="container p-5 m-3">
                    <div class="alert alert-info m-5 text-center">Aucun produit dans le panier</div>
                </div>
        @endif
    </div>
    </div>
@endsection
