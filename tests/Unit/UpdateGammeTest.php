<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Gamme;

class UpdateGammeTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
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

        // //modif gamme
        $gamme = Gamme::findOrFail(1);

        $this->put(
            route('gammes.update', $gamme),
            [
                'nom' => 'la meilleure gamme'
            ],
        );
        // vérif modif
        $this->assertDatabaseHas('gammes', ['nom' => 'la meilleure gamme']);
    }
}
