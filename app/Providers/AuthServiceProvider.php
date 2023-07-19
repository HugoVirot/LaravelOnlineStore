<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // je définis mon Gate en lui donnant un nom et en précisant les conditions
        // la fonction prend en paramètre le user connecté
        // 1er gate : vérifie que le user est admin pour accéder au back-office
        Gate::define('access_backoffice', function ($user) {

            return $user->isAdmin(); //condition à satisfaire pour passer le gate
            // autre syntaxe
            // if ($user->isAdmin()) {
            //     return true;
            // } else {
            //     return false;
            // }
        });

        // 2ème gate : vérifie que le user est connecté pour pouvoir accéder à la validation de commande
        Gate::define('access_order_validation', function () {
            return Auth::user();
        });
    }
}
