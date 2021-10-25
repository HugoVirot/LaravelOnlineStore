<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateGammeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;  // remet la bdd à son état initial après un test

    public function testGammeCreation()
    {
        // on initalise les données
        $data = [
            'nom' => 'ma super gamme',
        ];

        // on sauvegarde l'article en bdd
        $this->json('POST', 'gammes', $data);

        // on vérifie que la table gammes contient bien notre nouvel gammes
        $this->assertDatabaseHas('gammes', ['nom' => 'ma super gamme']);
    }
}
