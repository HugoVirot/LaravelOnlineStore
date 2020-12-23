<?php

/**
 * DisplayStock helper
 *
 * @param $campagnes
 * @param $articleId
 *
 * @return $campagne
 */

function displayStock($stock)
{
    if ($stock >= 10) {
        echo "<button class=\"btn btn-success btn-sm mb-3\">En stock</button>";
    } else if ($stock < 10 && $stock > 0) {
        echo "<button class=\"btn btn-warning btn-sm mb-3\">Plus que " . $stock . " en stock !</button>";
    } else {
        echo "<button class=\"btn btn-danger btn-sm mb-3\">Article en rupture de stock</button>";
    }
}
