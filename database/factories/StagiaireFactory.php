<?php
namespace Database\Factories;

use App\Models\Stagiaire;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StagiaireFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stagiaire::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'age' => $this->faker->numberBetween(17, 30),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Vous pouvez utiliser Hash::make() également
        ];
    }
}
