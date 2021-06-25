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
            'nom' => 'Promos départ en vacances',
            'reduction' => '20',
            'date_debut' => '2021-07-01',
            'date_fin' => '2021-07-07',
        ]);

        DB::table('campagnes')->insert([
            'nom' => 'Soldes d\'été',
            'reduction' => '15',
            'date_debut' => '2021-07-08',
            'date_fin' => '2021-08-31',
        ]);
    }
}
