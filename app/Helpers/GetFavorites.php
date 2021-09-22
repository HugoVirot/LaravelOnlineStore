<?php
/**
 * GetFavorites helper
 *
 * @return $favorisIds
 */
use Illuminate\Support\Facades\DB;

        // on récupère les favoris du user si connecté. 
        // pluck permet ici de récupérer uniquement les ids des articles en favoris
        // on l'utilise car le code qui précède génère une collection
        // on transforme ensuite le tout en array avec toArray()
        // dans la vue, on vérifiera si l'id de chaque article affiché fait partie des favoris
        // si oui => bouton "retirer des favoris" / sinon => bouton "ajouter aux favoris"
        
function getFavorites()
{
    if (auth()->user()) {
        $userId = auth()->user()->id;
        $favorisIds = DB::table('favoris')->where('user_id', '=', $userId)->pluck('article_id');
        $favorisIds = $favorisIds->toArray();
    } else {
        $favorisIds = null;
    }
    return $favorisIds;
}
