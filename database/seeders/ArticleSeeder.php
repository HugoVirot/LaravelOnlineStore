<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i++) {
            DB::table('articles')->insert([
                'nom' => 'Produit ' . $i,
                'description' => Str::random(50),
                'description_detaillee' => Str::random(100),
                'image' => 'product.png',
                'gamme_id' => rand(1,4),
                'prix' => rand(),
                'stock' => 50,
                'note' => 4.5,
            ]);
        }
    }
}
