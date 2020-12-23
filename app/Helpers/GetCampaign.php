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
        foreach ($campagne->articles as $article) {
            if ($article->id  == $articleId) {
                return $campagne;
            }
        }
    }
}
