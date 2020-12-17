@extends ('layouts.app')

@section('title')
Détails commande - Laravel Online Store
@endsection

@section('content')

<h4 class="text-center p-5"> Détails commande {{$commande->numero}}</h4>

<div class="container text-center">
    <p>Numéro : <b>{{$commande->numero}}</b></p>
    <p>Montant : <b>{{$commande->prix}} €</b></p>
    <p>Date : <b>{{$commande->created_at}}</b></p>
</div>

<div class="container">
    <table class="table table border border-primary">
        <thead class="thead-dark">
            <tr>
                <th scope="col">nom</th>
                <th scope="col">prix</th>
                <th scope="col">description</th>
                <th scope="col">quantité</th>
                <th scope="col">prix ligne</th>
            </tr>
        </thead>
        @php $total = 0;@endphp
        @foreach ($commande->articles as $article)
        <tr>
            <td>{{$article->nom}}</td>
            <td>{{$article->prix}}</td>
            <td>{{$article->description}}</td>
            <td>{{$article->pivot->quantite}}</td>
            <td>@php 
                echo $lineTotal = $article->prix * $article->pivot->quantite;
                $total += $lineTotal;
                @endphp</td>
        </tr>
        @endforeach
    </table>

    <p class="text-center">Frais de port : <b>
        @php 
        $shippingFees = $commande->prix - $total;
        echo number_format($shippingFees, 2, '.', '') . " €"; 
        @endphp</b></p>

</div>

@endsection