<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // on vérifie que la personne est bien connectée ET qu'elle est admin

        if (Auth::user() && Auth::user()->role_id == 2) {
            return $next($request);  // on continue
        }

        // autre syntaxe possible
        // if (Auth::user() && Auth::user()->isAdmin()) {

        // si les deux conditions ne sont pas remplies => on redirige vers l'accueil (ou erreur 403)
        //return redirect('/');
        abort(403, 'Vous n\'êtes pas administrateur : accès refusé');
    }
}
