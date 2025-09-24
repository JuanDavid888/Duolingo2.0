<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [
                'sp' => fake('es_ES')->unique()->word(),
                'en' => fake('en_US')->unique()->word(),
            ],
            'description' => [
                'sp' => substr(fake('es_ES')->paragraph(), 0, 150),
                'en' => substr(fake('en_US')->paragraph(), 0, 150),
            ],
        ];
    }
}
