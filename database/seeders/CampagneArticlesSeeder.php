<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CampagneArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campagne_articles')->insert([
            'campagne_id' => '1',
            'article_id' => '1',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '1',
            'article_id' => '2',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '1',
            'article_id' => '3',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '1',
            'article_id' => '4',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '1',
            'article_id' => '5',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '2',
            'article_id' => '6',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '2',
            'article_id' => '7',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '2',
            'article_id' => '8',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '2',
            'article_id' => '9',
        ]);
        
        DB::table('campagne_articles')->insert([
            'campagne_id' => '2',
            'article_id' => '10',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '3',
            'article_id' => '1',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '3',
            'article_id' => '2',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '3',
            'article_id' => '3',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '4',
            'article_id' => '4',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '4',
            'article_id' => '5',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '3',
            'article_id' => '6',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '3',
            'article_id' => '7',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '4',
            'article_id' => '8',
        ]);

        DB::table('campagne_articles')->insert([
            'campagne_id' => '4',
            'article_id' => '9',
        ]);
        
        DB::table('campagne_articles')->insert([
            'campagne_id' => '4',
            'article_id' => '10',
        ]);
    }
}
