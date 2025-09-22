<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Progress;
use App\Models\User;
use App\Models\Lesson;

class ProgressSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $lessons = Lesson::all();

        if ($users->isEmpty() || $lessons->isEmpty()) {
            $this->command->warn("No users or lessons found.");
            return;
        }

        foreach ($users as $user) {
            // Prevent make a progress if user have a lesson below 80
            $lowScoreExists = Progress::where('id_user', $user->id)
                ->where('score', '<', 80)
                ->exists();

            if ($lowScoreExists) {
                $this->command->line("User ID {$user->id} has lessons with score < 80, skipping new progress.");
                continue;
            }

            // Obtain all lessons completed
            $completedLessonIds = Progress::where('id_user', $user->id)
                ->pluck('id_lesson')
                ->toArray();

            // Filter lessons that the user doesn't have associated
            $availableLessons = $lessons->whereNotIn('id', $completedLessonIds);

            if ($availableLessons->isEmpty()) {
                $this->command->line("User ID {$user->id} has progress for all lessons.");
                continue;
            }

            $lesson = $availableLessons->random();

            Progress::factory()->create([
                'id_user' => $user->id,
                'id_lesson' => $lesson->id,
                'score' => fake()->numberBetween(0, 100),
            ]);

            $this->command->info("Created progress for user {$user->id} on lesson {$lesson->id}");
        }
    }
}