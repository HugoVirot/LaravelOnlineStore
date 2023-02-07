<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Campagne;

class CampagneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campagne::create([
            'nom' => 'Promos du printemps',
            'reduction' => '20',
            'date_debut' => '2023-03-21',
            'date_fin' => '2023-04-30',
        ]);

        Campagne::create([
            'nom' => 'Les immanquables de l\'été',
            'reduction' => '25',
            'date_debut' => '2023-07-01',
            'date_fin' => '2023-08-31',
        ]);

        Campagne::create([
            'nom' => 'Soldes d\'automne',
            'reduction' => '15',
            'date_debut' => '2022-09-11',
            'date_fin' => '2022-10-31',
        ]);

        Campagne::create([
            'nom' => 'Promos de Noël',
            'reduction' => '10',
            'date_debut' => '2022-12-01',
            'date_fin' => '2022-12-31',
        ]);

        Campagne::create([
            'nom' => 'Promos Hiver 2023',
            'reduction' => '10',
            'date_debut' => '2023-01-01',
            'date_fin' => '2023-01-31',
        ]);
    }
}
