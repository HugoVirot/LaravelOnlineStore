<?php

namespace Tests\Feature;

use App\Models\Gamme;
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
        // on vérifie que la base de données ne contient aucune gamme
        $this->assertEquals(0, Gamme::count());

        // on initalise les données
        $data = [
            'nom' => 'ma super gamme',
        ];

        // on sauvegarde la gamme en bdd
        $this->json('POST', 'gammes', $data);

        // on vérifie que la table gammes contient bien une gamme
        $this->assertEquals(1, Gamme::count());

        // on vérifie qu'il s'agit bien de notre nouvelle gamme
        $this->assertDatabaseHas('gammes', ['nom' => 'ma super gamme']);
    }
}
