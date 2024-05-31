<?php

namespace Database\Factories;

use App\Models\Livre;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

class LivreFactory extends Factory
{
    protected $model = Livre::class;

    public function definition()
    {
        return [
            'titre' => $this->faker->sentence,
            'pages' => $this->faker->numberBetween(100, 1000),
            'description' => $this->faker->paragraph,
            'categorie_id' => Categorie::inRandomOrder()->first()->id,
            'image' => $this->faker->imageUrl(640, 480, 'books', true),
        ];
    }
}
