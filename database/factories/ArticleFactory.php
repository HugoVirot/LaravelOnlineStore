<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $number = 1;

        return [
            'nom' => 'Produit ' . $number++,
            'description' => $this->faker->sentence(),
            'description_detaillee' => $this->faker->paragraph(),
            'image' => 'logo.png',
            'gamme_id' => rand(1,4),
            'prix' => mt_rand(5, 1000),
            'stock' => rand(1, 100),
            'note' => rand(3, 5),
        ];
    }
}
