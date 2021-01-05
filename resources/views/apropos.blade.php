@extends('layouts.app')

@section('title')
    A propos - Laravel Online Store
@endsection

@section('content')

<h1 class="pb-3 text-center">Notre histoire</h1>

<div class="container-fluid text-center p-3">
    <img src="{{ asset("images/evolution.png") }}" alt="logo" style="width : 80vw">
</div>

<div class="container text-center w-75 p-5">
    <div class="row justify-content-center">
        <p>
            Fondé en 1988, l'entreprise Laravel Digital Equipment est née avec cette philosophie : <b>vous proposer les meilleurs produits hi-tech du marché, à des prix défiant toute concurrence.</b><br>
            A l'origine, un magasin, le Laravel Store, situé à Paris, fournit les franciliens en ordinateurs Apple, en consoles Atari et en disquettes.<br>
            Avec le temps, nos ordinateurs, téléphones et autres joujoux numériques ont considérablement évolué, devenant toujours plus performants, élégants et faciles à utiliser.<br>
            Dans le même temps, la demande a explosé, ce qui nous a conduit à ouvrir la boutique en ligne à la fin des années 90.<br>
            Notre magasin a été fermé depuis. Nous vendons donc exclusivement en ligne, ce qui nous permet de proposer des prix très compétitifs.<br>
            <b>Laravel Online Store vous propose ainsi, depuis plus de 32 ans, le meilleur de la technologie.</b><br>
            Aujourd'hui, nous avons plus de 150 millions de clients réguliers, dans 73 pays. Et pourquoi pas vous ?<br>
        </p>
    </div>
</div>

<h1 class="pb-3 text-center">Qualité</h1>

<div class="container-fluid text-center p-3">
    <img src="{{ asset("images/history.jpg") }}" alt="logo" style="width : 80vw">
</div>

<div class="container text-center w-75 p-5">
    <div class="row justify-content-center">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, incidunt quam inventore perspiciatis error quas totam similique illum architecto, facilis praesentium qui ex laudantium laborum aperiam odit enim dolor numquam.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, incidunt quam inventore perspiciatis error quas totam similique illum architecto, facilis praesentium qui ex laudantium laborum aperiam odit enim dolor numquam.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, incidunt quam inventore perspiciatis error quas totam similique illum architecto, facilis praesentium qui ex laudantium laborum aperiam odit enim dolor numquam.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, incidunt quam inventore perspiciatis error quas totam similique illum architecto, facilis praesentium qui ex laudantium laborum aperiam odit enim dolor numquam.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, incidunt quam inventore perspiciatis error quas totam similique illum architecto, facilis praesentium qui ex laudantium laborum aperiam odit enim dolor numquam.
        </p>
    </div>
</div>
@endsection