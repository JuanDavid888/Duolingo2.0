<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    public function definition(): array
    {
        // Define valid extensions and MIME types
        $types = [
            ['ext' => 'jpg', 'mime' => 'image/jpeg'],
            ['ext' => 'png', 'mime' => 'image/png'],
            ['ext' => 'svg', 'mime' => 'image/svg+xml'],
            ['ext' => 'mp3', 'mime' => 'audio/mpeg'],
        ];

        // Choose a random type
        $type = fake()->randomElement($types);

        return [
            'word' => [
            'es' => fake('es_ES')->unique()->word(),
            'en' => fake('en_US')->unique()->word(),
        ],
            'file_path' => 'uploads/' . fake()->unique()->uuid() . '.' . $type['ext'],
            'mime_type' => $type['mime'],
            'code' => strtoupper(fake()->unique()->bothify('?##????#??'))
        ];
    }
}