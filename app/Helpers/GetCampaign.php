<?php

use App\Models\Campagne;
/**
 * GetCampaign helper
 *
 * @param $articleId
 *
 * @return $campagne
 */

 // renvoie la promo associée au produit dont l'id est en paramètre
 // si et seulement si elle est en cours
 
function getCampaign($articleId)
{
    foreach (Campagne::all() as $campagne) {
        // si et seulement si la campagne est en cours
        if ($campagne->date_debut <= date('Y-m-d') && $campagne->date_fin >= date('Y-m-d')) {
            
            // je boucle sur ses articles
            foreach ($campagne->articles as $article) {
                
                // si je trouve mon article dedans => il en fait partie
                if ($article->id == $articleId) {
                  
                    // je retourne donc la campagne
                    return $campagne;
                }
            }
            
            // retourner null signifie que mon article ne fait partie d'aucune campagne
            // actuelle ou future
            return null;
        }
    }
}
