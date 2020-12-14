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
            'nom' => 'Black Friday',
            'reduction' => '20',
            'date_debut' => '2020-12-17',
            'date_fin' => '2020-12-19',
        ]);

        DB::table('campagnes')->insert([
            'nom' => 'Promos de Noël',
            'reduction' => '15',
            'date_debut' => '2020-12-20',
            'date_fin' => '2020-12-26',
        ]);
    }
}
