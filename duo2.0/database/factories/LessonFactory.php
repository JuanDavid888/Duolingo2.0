<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => [
                'es' => fake('es_ES')->sentence(3),
                'en' => fake('en_US')->sentence(3),
            ],

            'description' => [
                'es' => substr(fake('es_ES')->paragraph(), 0, 150),
                'en' => substr(fake('en_US')->paragraph(), 0, 150),
            ],

            'level' => [
                'es' => fake('es_ES')->randomElement(['principiante', 'intermedio', 'avanzado']),
                'en' => fake('en_US')->randomElement(['beginner', 'intermediate', 'advanced']),
            ],
        ];
    }
}
