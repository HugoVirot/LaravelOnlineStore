@extends('layouts.app')

@section('title')
    Back-office - Laravel Online Store
@endsection

@section('content')

    <script>
          let nomsTableaux = ['articlesForm', 'rangesForm', 'campaignsForm', 'articlesList', 'rangesList',
            'campaignsList', 'usersList']

        function showElement(elementId) {

            nomsTableaux.forEach(element => { // nom du tableau 
                document.getElementById(element).style.display = 'none'
            });

            let element = document.getElementById(elementId);

            // écriture ternaire
            element.style.display == "block" ? element.style.display = "none" : element.style.display = "block";

            // autre écriture
            // if (element.style.display == "block" ){
            //     element.style.display = "none" p
            // } else {
            //     element.style.display = "block"
            // }
        }
    </script>

    <div class="container text-center pt-3 mb-3">
        <h1 class="pb-5">Back-office</h1>
        <div class="row mb-3 justify-content-around">
            <button class="btn btn-lg btn-primary" onclick="showElement('articlesForm')">Créer un article</button>
            <button class="btn btn-lg btn-primary" onclick="showElement('rangesForm')">Créer une gamme</button>
            <button class="btn btn-lg btn-primary" onclick="showElement('campaignsForm')">Créer une campagne promo</button>
        </div>
        <div class="row justify-content-around">
            <button class="btn btn-lg btn-secondary" onclick="showElement('articlesList')">Liste des articles</button>
            <button class="btn btn-lg btn-secondary" onclick="showElement('rangesList')">Liste des gammes</button>
            <button class="btn btn-lg btn-secondary" onclick="showElement('campaignsList')">Liste des campagnes</button>
            <button class="btn btn-lg btn-secondary" onclick="showElement('usersList')">Liste des utilisateurs</button>
        </div>

        <!-- Créer un article -->

        <div class="container w-50 p-5" style="display:none" id="articlesForm">
            <h3>Créer un article</h3>
            <form method="post" action="{{ route('articles.store') }}">
                @csrf
                <div class="form-group">
                    <label for="nom">nom</label>
                    <input required type="text" class="form-control" name="nom" value="" id="nom">
                </div>
                <div class="form-group">
                    <label for="description">description</label>
                    <input required type="text" class="form-control" name="description" value="" id="description">
                </div>
                <div class="form-group">
                    <label for="description_detaillee">description détaillée</label>
                    <input required type="text" class="form-control" name="description_detaillee" value=""
                        id="description_detaillee">
                </div>
                <div class="form-group">
                    <label for="image">image</label>
                    <input required type="text" class="form-control" name="image" value="" id="image">
                </div>
                <div class="form-group">
                    <label for="prix">prix</label>
                    <input required type="text" class="form-control" name="prix" value="" id="prix">
                </div>
                <div class="form-group">
                    <label for="stock">stock</label>
                    <input required type="text" class="form-control" name="stock" value="" id="stock">
                </div>
                <div class="form-group">
                    <label for="note">note</label>
                    <input required type="text" class="form-control" name="note" value="" id="note">
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
                <button type="submit" class="btn btn-info text-light mt-4">Valider</button>
            </form>
        </div>

        <!-- Liste des articles -->

        <div class="container p-5" style="display:none" id="articlesList">
            <h3 class="mb-3">Liste des articles</h3>

            <table class="table table-info">
                <thead class="thead-dark">
                    <th>Nom</th>
                    <th>description</th>
                    <th>image</th>
                    <th>prix</th>
                    <th>stock</th>
                    <th>note</th>
                    <th>modifier</th>
                    <th>supprimer</th>
                </thead>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->nom }}</td>
                        <td>{{ $article->description }}</td>
                        <td>{{ $article->image }}</td>
                        <td>{{ $article->prix }}</td>
                        <td>{{ $article->stock }}</td>
                        <td>{{ $article->note }}</td>
                        <td><a href="{{ route('articles.edit', $article) }}"><button
                                    class="btn btn-warning">Modifier</button></a></td>
                        <td>
                            <form method="post" action="{{ route('articles.destroy', $article) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>


        <!-- Créer une gamme -->

        <div class="container w-50 p-5" style="display:none" id="rangesForm">
            <h3>Créer une gamme</h3>
            <form method="post" action="{{ route('gammes.store') }}">
                @csrf
                <div class="form-group">
                    <label for="nom">nom</label>
                    <input required type="text" class="form-control" name="nom" value="" id="nom">
                </div>
                <button type="submit" class="btn btn-info text-light mt-4">Valider</button>
            </form>
        </div>


        <!-- Liste des gammes -->

        <div class="container w-50 p-5" style="display:none" id="rangesList">
            <h3 class="mb-3">Liste des gammes</h3>

            <table class="table table-info">
                <thead class="thead-dark">
                    <th>id</th>
                    <th>nom</th>
                    <th>modifier</th>
                    <th>supprimer</th>
                </thead>
                @foreach ($gammes as $gamme)
                    <tr>
                        <td>{{ $gamme->id }}</td>
                        <td>{{ $gamme->nom }}</td>
                        <td><a href="{{ route('gammes.edit', $gamme) }}"><button
                                    class="btn btn-warning">Modifier</button></a></td>
                        <td>
                            <form method="post" action="{{ route('gammes.destroy', $gamme) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>


    <!-- Créer une campagne -->

    <div class="container w-50 p-5" style="display:none" id="campaignsForm">
        <h3>Créer une campagne</h3>
        <form method="post" action="{{ route('campagnes.store') }}">
            @csrf
            <div class="form-group">
                <label for="nom">nom</label>
                <input required type="text" class="form-control" name="nom" value="" id="nom">
            </div>
            <div class="form-group">
                <label for="reduction">réduction</label>
                <input required type="text" class="form-control" name="reduction" value="" id="reduction">
            </div>
            <div class="form-group">
                <label for="date_debut">date de début</label>
                <input required type="text" class="form-control" name="date_debut" value="" id="date_debut">
            </div>
            <div class="form-group">
                <label for="date_fin">date de fin</label>
                <input required type="text" class="form-control" name="date_fin" value="" id="date_fin">
            </div>
            <div class="form-group">
                @foreach ($articles as $article)
                    <input type="checkbox" id="article{{ $article->id }}" name="article{{ $article->id }}"
                        value="{{ $article->id }}">
                    <label for="article{{ $article->id }}">{{ $article->nom }}</label>
                @endforeach
                <button type="submit" class="btn btn-info text-light mt-4">Valider</button>
            </div>
        </form>
    </div>

    <!-- Liste des campagnes -->

    <div class="container p-5" style="display:none" id="campaignsList">
        <h3 class="mb-3">Liste des campagnes</h3>

        <table class="table table-info">
            <thead class="thead-dark">
                <th>Nom</th>
                <th>Réduction</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </thead>
            @foreach ($campagnes as $campagne)
                <tr>
                    <td>{{ $campagne->nom }}</td>
                    <td>{{ $campagne->reduction }} %</td>
                    <td>{{ $campagne->date_debut }}</td>
                    <td>{{ $campagne->date_fin }}</td>
                    <td><a href="{{ route('campagnes.edit', $campagne) }}"><button
                                class="btn btn-warning">Modifier</button></a></td>
                    <td>
                        <form method="post" action="{{ route('campagnes.destroy', $campagne) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>


    <!-- Liste des utilisateurs -->

    <div class="container p-5" style="display:none" id="usersList">
        <h3 class="mb-3">Liste des utilisateurs</h3>

        <table class="table table-info">
            <thead class="thead-dark">
                <th>id</th>
                <th>nom</th>
                <th>prénom</th>
                <th>pseudo</th>
                <th>e-mail</th>
                <th>rôle</th>
                <th>supprimer</th>
            </thead>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->nom }}</td>
                    <td>{{ $user->prenom }}</td>
                    <td>{{ $user->pseudo }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->role }}</td>
                    <td>
                        <form method="post" action="{{ route('user.delete') }}">
                            @csrf
                            @method('delete')
                            <input type="hidden" value="{{ $user->id }}" name="userId">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    </div>
@endsection
