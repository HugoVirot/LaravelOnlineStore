<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Adresse;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateAddressTest extends TestCase  // test de création d'une nouvelle adresse
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;  // remet la bdd à son état initial après un test

    /** @test */
    public function testAddressCreation()
    {

        // on vérifie que l'on part d'une table adresses vide
        $this->assertEquals(0, Adresse::count());

        // on crée le rôle user
        DB::table('roles')->insert([
            'role' => 'user'
        ]);

        // on crée un user
        User::create([
            'nom' => 'Test',
            'prenom' => 'paul',
            'pseudo' => 'paulTest',
            'email' => 'paul@test.fr',
            'password' => 'Azerty77@',
            'password_confirmation' => 'Azerty77@'
        ]);

        // on initialise les données de ladresse
        $data = [
            'adresse' => '1 rue du test',
            'code_postal' => '99999',
            'ville' => 'Testville',
            'user_id' => 1
        ];

        // on sauvegarde l'adresse en bdd
        $this->json('POST', 'address/store', $data);

        // on vérifie que la table adresses contient bien notre nouvelle adresse
        $this->assertEquals(1, Adresse::count());

        // on récupère la nouvelle adresse dans la base
        $address = Adresse::first();

        // on vérifie qu'elle correspond à nos données insérées
        $this->assertEquals($data['adresse'], $address->adresse);
        $this->assertEquals($data['code_postal'], $address->code_postal);
        $this->assertEquals($data['ville'], $address->ville);
        $this->assertEquals($data['user_id'], $address->user_id);
    }
}

// liste des assertions de PHPUnit

// AssertTrue: Vérifiez l'entrée pour vérifier qu'elle est égale à true.
// AssertFalse: Vérifiez l'entrée pour vérifier qu'elle est égale à la valeur fausse.
// AssertEquals: Comparer le résultat avec une autre entrée pour une correspondance.
// AssertArrayHasKey (): Signale une erreur si le tableau n'a pas la clé.
// AssertGreaterThan: Vérifiez le résultat pour voir s'il est supérieur à une valeur.
// AssertContains: Vérifie que l'entrée contient une certaine valeur.
// AssertType: Vérifie qu'une variable est d'un certain type.
// AssertNull: Vérifier qu'une variable est nulle.
// AssertFileExists: Vérifier qu'un fichier existe.
// AssertRegExp: Vérifie l'entrée par rapport à une expression régulière.
