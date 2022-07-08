<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Companies>
 */
class CompaniesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    // Generate fake data for table Companies
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'activity' => $this->faker->randomElement(['Séismologue', 'Technicien plateau', 'Porteur de hottes', 'Ingénieur géomètre']),
            'country' => 'France',
            'town' => $this->faker->city(),
        ];
    }
}
