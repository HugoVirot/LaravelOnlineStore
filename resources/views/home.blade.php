@extends('layouts.app')

@section('content')
<div class="container-fluid text-center p-3">
    <img src="{{ asset("images/banner.jpg") }}" alt="logo" style="width : 80vw">
</div>
<div class="container text-center p-5">
    <h1>Promotions de Noël</h1>
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-4 card" style="width: 18rem;">
            <img src="{{ asset("images/product.png") }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Produit</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <div class="col-md-4 card" style="width: 18rem;">
        <img src="{{ asset("images/product.png") }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Produit</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <div class="col-md-4 card" style="width: 18rem;">
        <img src="{{ asset("images/product.png") }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</div>
<div class="container text-center p-5">
    <h1>Produits stars</h1>
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-4 card" style="width: 18rem;">
        <img src="{{ asset("images/product.png") }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <div class="col-md-4 card" style="width: 18rem;">
        <img src="{{ asset("images/product.png") }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <div class="col-md-4 card" style="width: 18rem;">
        <img src="{{ asset("images/product.png") }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</div>
@endsection