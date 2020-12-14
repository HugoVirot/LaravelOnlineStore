<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GammeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gammes')->insert([
            'nom' => 'informatique',
        ]);

        DB::table('gammes')->insert([
            'nom' => 'téléphonie',
        ]);

        DB::table('gammes')->insert([
            'nom' => 'son',
        ]);

        DB::table('gammes')->insert([
            'nom' => 'produits connectés',
        ]);
    }
}
