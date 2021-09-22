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
            'nom' => 'Promos de la rentrée',
            'reduction' => '20',
            'date_debut' => '2021-09-01',
            'date_fin' => '2021-09-10',
        ]);

        DB::table('campagnes')->insert([
            'nom' => 'Soldes d\'automne',
            'reduction' => '15',
            'date_debut' => '2021-09-11',
            'date_fin' => '2021-10-31',
        ]);
    }
}
