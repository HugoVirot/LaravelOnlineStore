<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // création de l'administrateur
        User::create([
            'pseudo' => 'administrateur',
            'nom' => 'Admin',
            'prenom' => 'Admin',
            'password' => Hash::make('Azerty88@'),
            'email' => 'admin@niceplaces.fr',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role_id' => 2
        ]);

        // création d'un utilisateur de test
        User::create([
            'pseudo' => 'utilisateur',
            'nom' => 'Martin',
            'prenom' => 'Paul',
            'password' => Hash::make('Azerty88@'),
            'email' => 'utilisateur@test.fr',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role_id' => 1
        ]);

        // création de 8 users aléatoires
        User::factory(8)->create();
    }
}
