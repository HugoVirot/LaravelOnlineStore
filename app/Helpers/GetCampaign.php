<?php

use App\Models\Campagne;
/**
 * GetCampaign helper
 *
 * @param $articleId
 *
 * @return $campagne
 */

function getCampaign($articleId)
{
    foreach (Campagne::all() as $campagne) {
        if ($campagne->date_debut <= date('Y-m-d') && $campagne->date_fin >= date('Y-m-d')) {
            foreach ($campagne->articles as $article) {
                if ($article->id  == $articleId) {
                    return $campagne;
                }
            }
        }
    }
}
