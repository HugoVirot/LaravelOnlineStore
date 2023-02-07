<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Gamme;

class UpdateGammeTest extends TestCase
{

    use RefreshDatabase;
    /**
     *
     * @return void
     */

    public function testUpdateGamme()
    {
        // création gamme
        $data = [
            'nom' => 'ma super gamme'
        ];

        $this->json('POST', 'gammes', $data);

        // vérif : gamme bien insérée en base
        $this->assertEquals(1, Gamme::count());
        $this->assertDatabaseHas('gammes', ['nom' => 'ma super gamme']);

        // modif gamme
        $gamme = Gamme::first(); // récupération gamme en fonction de son id

        $this->put(      // modif gamme avec route gammeS.update en passant la gamme en paramètre de la route
            route('gammes.update', $gamme),
            [
                'nom' => 'la meilleure gamme'  // je lui change son nom
            ],
        );

        // vérif modif
        $this->assertDatabaseHas('gammes', ['nom' => 'la meilleure gamme']);
    }
}
