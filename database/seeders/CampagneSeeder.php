<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CampagneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campagnes')->insert([
            'nom' => 'Promos du printemps',
            'reduction' => '20',
            'date_debut' => '2022-03-21',
            'date_fin' => '2022-04-30',
        ]);

        DB::table('campagnes')->insert([
            'nom' => 'Les immanquables de l\'été',
            'reduction' => '25',
            'date_debut' => '2022-07-01',
            'date_fin' => '2022-08-31',
        ]);

        DB::table('campagnes')->insert([
            'nom' => 'Soldes d\'automne',
            'reduction' => '15',
            'date_debut' => '2021-09-11',
            'date_fin' => '2021-10-31',
        ]);

        DB::table('campagnes')->insert([
            'nom' => 'Promos de Noël',
            'reduction' => '10',
            'date_debut' => '2022-12-01',
            'date_fin' => '2022-12-31',
        ]);
    }
}
