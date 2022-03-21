@extends ('layouts.app')

@section('title')
Détails commande - Laravel Online Store
@endsection

@section('content')

<h4 class="text-center p-5"> Détails commande n° {{$commande->numero}}</h4>

<div class="container text-center">
    <h5>Montant : <b>{{$commande->prix}} €</b></h5>
    <br>
    <h5>Date : 
   <b>@php echo \Carbon\Carbon::parse($commande->created_at)->translatedFormat('l d F Y à H\hi') 
   @endphp</b></h5>
   <br>
</div>

<div class="container">
    <table class="table table border border-primary">
        <thead class="thead-dark">
            <tr>
                <th scope="col">nom</th>
                <th scope="col">prix</th>
                <th scope="col">réduction</th>
                <th scope="col">description</th>
                <th scope="col">quantité</th>
                <th scope="col">prix ligne</th>
            </tr>
        </thead>
        @php $total = 0;  // prix total des articles sans les frais de port 
        @endphp

        @foreach ($commande->articles as $article)

        <tr>
            <td>{{$article->nom}}</td>
            
            @if(($article->pivot->reduction) != 0)
            <td>{{$article->prix -= $article->prix * $article->pivot->reduction/100 }}</td>
            <td>-{{$article->pivot->reduction}}%</td>

            @else
            <td>{{$article->prix}}</td>
            <td>aucune</td>
            @endif

            <td>{{$article->description}}</td>
            <td>{{$article->pivot->quantite}}</td>
            <td>@php 
                echo $lineTotal = $article->prix * $article->pivot->quantite;  // prix de chaque ligne
                $total += $lineTotal;   // on l'ajoute au total général
                @endphp</td>
        </tr>
        @endforeach
    </table>

    <p class="text-center">Frais de port : <b>
        @php 
        $shippingFees = $commande->prix - $total;  // frais de port = prix total de la commande - prix total des articles
        echo number_format($shippingFees, 2, '.', '') . " €"; 
        @endphp</b></p>

</div>

@endsection