<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card;
use App\Models\Lesson;
use App\Models\Category;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $lessons = Lesson::all();

        // Validation to prevent nulls
        if ($categories->isEmpty() || $lessons->isEmpty()) {
            $this->command->warn("No categories or lessons available to associate with cards.");
            return;
        }

        foreach ($lessons as $lesson) {
            $existingCards = $lesson->cards()->count();

            if ($existingCards >= 8) {
                $this->command->line("Lesson ID {$lesson->id} already has 8 or more cards. Skipping.");
                continue;
            }

            $cardsToCreate = 8 - $existingCards;

            Card::factory()->count($cardsToCreate)
                ->create([
                    'id_lesson' => $lesson->id,
                    'id_category' => $lesson->id_category,
                ]);

            $this->command->line("Added {$cardsToCreate} card(s) to Lesson ID {$lesson->id}.");
        }

        $this->command->info("Cards successfully created and associated with lessons (up to 8 per lesson).");
    }
}
