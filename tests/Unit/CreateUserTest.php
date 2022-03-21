<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateUserTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function testCreateUser()
    {
        // on vérifie que l'on part d'une table users vide
        $this->assertEquals(0, User::count());

        DB::table('roles')->insert([
            'role' => 'user'
        ]);

        // on initialise les données
        $data = [
            'nom' => 'paul',
            'prenom' => 'paul',
            'pseudo' => 'paulpaul',
            'email' => 'test@test.fr',
            'password' => 'Azerty77@',
            'password_confirmation' => 'Azerty77@',
        ];

        // on sauvegarde le user en bdd
        $this->json('POST', 'register', $data);

        // on vérifie que la table users contient bien notre nouveau user
        $this->assertEquals(1, User::count());

        // on récupère le nouveau user dans la base
        $user = User::first();

        // on vérifie qu'il correspond à nos données insérées
        $this->assertEquals($data['nom'], $user->nom);
        $this->assertEquals($data['prenom'], $user->prenom);
        $this->assertEquals($data['pseudo'], $user->pseudo);
        $this->assertEquals($data['email'], $user->email);
    }
}
