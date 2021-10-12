<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Gamme;

class DeleteGammeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;  // remet la bdd à son état initial après un test

    public function testGammeDeletion()
    {
        // on initialise les données (comme si elles venaient d'un formulaire)
        $data = [
            'nom' => 'ma super gamme',
        ];

        // on sauvegarde l'article en bdd (appel route store) comme si on validait le formulaire
        $this->json('POST', 'gammes', $data);

        // on récupère la gamme en bdd
        $gamme = Gamme::where('id', 1)->get();

        // on supprime la gamme
        $this->delete(route('gammes.destroy', $gamme));

        // on vérifie qu'elle a bien été supprimée
        $this->assertDeleted('gammes', ['nom' => 'ma super gamme']);
    }
}
