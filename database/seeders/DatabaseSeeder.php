<?php

namespace Database\Seeders;

use App\Models\Campagne;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ArticleSeeder::class,
            GammeSeeder::class,
            CampagneSeeder::class,
            CampagneArticlesSeeder::class,
            RoleSeeder::class
        ]);
    }
}
