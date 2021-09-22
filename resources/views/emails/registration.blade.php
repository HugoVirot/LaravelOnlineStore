@component('mail::message')
Bonjour {{ $user->prenom . ' ' . $user->nom }} !

Félicitations, ton inscription est validée sur Laravel Online Store !

@component('mail::button', ['url' => $url, 'color' => 'success'])
Accéder au site
@endcomponent

A très bientôt sur notre site!<br>
{{ config('app.name') }}
@endcomponent
