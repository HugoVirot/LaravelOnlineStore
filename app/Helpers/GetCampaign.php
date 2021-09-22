<?php

/**
 * GetCampaign helper
 *
 * @param $campagnes
 * @param $articleId
 *
 * @return $campagne
 */

function getCampaign($campagnes, $articleId)
{
    foreach ($campagnes as $campagne) {
        if ($campagne->date_debut <= date('Y-m-d') && $campagne->date_fin >= date('Y-m-d')) {
            foreach ($campagne->articles as $article) {
                if ($article->id  == $articleId) {
                    return $campagne;
                }
            }
        }
    }
}
