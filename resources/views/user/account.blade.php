@extends ('layouts.app')

@section('title')
    Mon compte - Laravel Online Store
@endsection

@section('content')

    <div class="container">
        <h1 class="text-center p-2">Mon compte</h1>
        <h4 class="text-center p-3">Bienvenue chez vous, {{ $user->pseudo }} ! </h4>
        <div class="row">

            <div class="col-md-6">

                <h4 class="text-center p-4">Mes informations</h4>

                <div class="row">
                    <div class="col-10 offset-1 text-center">
                        <form class="col-12 mx-auto p-5 border border-info" action="{{ route('account.update') }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="prenom">Prénom</label>
                                <input required type="text" class="form-control" name="prenom"
                                    value="{{ $user->prenom }}" id="prenom">
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input required type="text" class="form-control" name="nom" value="{{ $user->nom }}"
                                    id="nom">
                            </div>
                            <div class="form-group">
                                <label for="pseudo">Pseudo</label>
                                <input required type="text" class="form-control" name="pseudo"
                                    value="{{ $user->pseudo }}" id="pseudo">
                            </div>
                            <input type="hidden" name="email" value="{{ $user->email }}" id="email">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input required type="email" class="form-control" name="email"
                                    value="{{ $user->email }}" id="email">
                            </div>
                            <button type="submit" class="btn btn-info text-light mt-4">Modifier</button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <h4 class="text-center p-4">Modifier mon mot de passe</h4>

                <div class="row">
                    <div class="col-10 offset-1 text-center">
                        <form class="col-12 mx-auto p-5 border border-info" action="{{ route('account.updatePassword') }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mt-4">
                                <label class="label">Mot de passe actuel</label>
                                <div class="control">
                                    <input class="form-control" type="password" name="currentPassword">
                                </div>
                                @if ($errors->has('password'))
                                    <p class="help is-danger">{{ $errors->first('currentPassword') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="label">Nouveau mot de passe</label>
                                <div class="control">
                                    <input class="form-control" type="password" name="newPassword">
                                </div>
                                @if ($errors->has('password'))
                                    <p class="help is-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="label">Confirmez le mot de passe</label>
                                <div class="control">
                                    <input class="form-control" type="password" name="newPassword_confirmation">
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                                @endif
                                @if ($errors->has('password_error'))
                                    <p class="help is-danger">{{ $errors->first('password_error') }}</p>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-info text-light mt-4">Modifier</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <h4 class="text-center p-4">Mes adresses</h4>
    @foreach ($user->adresses as $adress)
        <div class="row w-75 m-auto">
            <div class="col-6 offset-3 text-center border border-info">
                <form class="col-12 mx-auto pt-5" action="{{ route('address.update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input name="adresse" type="text" class="form-control" id="adresse"
                            value="{{ $adress->adresse }}" required>
                    </div>
                    <div class="form-group">
                        <label for="code_postal">Code Postal</label>
                        <input name="code_postal" type="text" class="form-control" id="code_postal"
                            value="{{ $adress->code_postal }}" required>
                    </div>
                    <div class="form-group">
                        <label for="ville">Ville</label>
                        <input name="ville" type="text" class="form-control" id="ville" value="{{ $adress->ville }}"
                            required>
                    </div>
                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                    <input type="hidden" value="{{ $adress->id }}" name="adresse_id">
                    <div class="row justify-content-center mt-4">
                        <button type="submit" class="btn btn-info text-light">Modifier</button>
                    </div>
                </form>
                <form action="{{ route('address.delete') }}" class="p-3" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" value="{{ $adress->id }}" name="adresse_id">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    @endforeach

    @if (count($user->adresses) < 2)
        <h5 class="text-center pt-4 pb-3"> Ajouter une adresse (maximum 2)</h5>

        <div class="row text-center w-75 m-auto mt-4">
            <div class="col-6 offset-3 text-center">
                <form class="col-12 mx-auto p-5 border border-info" action="{{ route('address.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input name="adresse" type="text" class="form-control" id="adresse" placeholder="15, rue Laravel"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="code_postal">Code Postal</label>
                        <input name="code_postal" type="text" class="form-control" id="code_postal" placeholder="12345"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="ville">Ville</label>
                        <input name="ville" type="text" class="form-control" id="ville" placeholder="PHPCITY" required>
                    </div>
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                    <div class="row justify-content-center mt-4">
                        <button type="submit" class="btn btn-info text-light">Enregistrer l'adresse</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <h4 class="text-center pt-5"> Mes commandes</h4>

    @if (isset($user->commandes) && count($user->commandes) > 0)
        <div class="container">
            <table class="table table border border-primary">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">numéro</th>
                        <th scope="col">prix</th>
                        <th scope="col">date</th>
                        <th scope="col">détails</th>
                    </tr>
                </thead>
                @foreach ($user->commandes as $commande)
                    <tr>
                        <td>{{ $commande->numero }}</td>
                        <td>{{ $commande->prix }}</td>
                        <td>
                            @php echo \Carbon\Carbon::parse($commande->created_at)->translatedFormat('l d F Y à H\hi');
                            @endphp</td>
                        <td>
                            <form action="{{ route('commandes.show', $commande) }}" method="get">
                                <button type="submit" class="btn btn-primary">Détails</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @else
        <p class="text-center p-5"> Vous n'avez pas encore passé de commande.</p>
    @endif

@endsection
