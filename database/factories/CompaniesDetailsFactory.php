<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Companies;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompaniesDetails>
 */
class CompaniesDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    // Generate fake data for table CompaniesDetails
    public function definition()
    {
        return [
            'companies_id' => Companies::factory()->create()->id,
            'website' => $this->faker->domainName(),
            'phone' => $this->faker->mobileNumber(),
            'zipcode' => $this->faker->departmentNumber(),
            'nbemployees' => $this->faker->numberBetween(5, 1000),
            'netsales' => $this->faker->numberBetween(10000, 1000000),
        ];
    }
}
