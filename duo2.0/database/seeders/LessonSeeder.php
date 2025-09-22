<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Category;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        // Validation to prevent nulls
        if ($categories->isEmpty()) {
            $this->command->warn("There are no categories to associate with the lessons.");
            return;
        }

        Lesson::factory()->count(3)->make()
            ->each(function ($lesson) use ($categories) {
                $lesson->id_category = $categories->random()->id;
                $lesson->save();
            });

        $this->command->info("Lessons created and assigned categories.");
    }
}