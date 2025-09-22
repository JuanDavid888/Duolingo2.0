<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Answer;
use App\Models\Card;

class AnswerSeeder extends Seeder
{
    public function run(): void
    {
        $cards = Card::all();

        if ($cards->isEmpty()) {
            $this->command->warn("No cards found to associate answers.");
            return;
        }

        foreach ($cards as $card) {
            Answer::factory()
                ->count(1)
                ->create([
                    'id_card' => $card->id,
                    'card_code' => $card->code,
                ]);

            $this->command->line("Created 2 answers for card ID {$card->id} with code {$card->code}");
        }

        $this->command->info("Answers created and associated with cards.");
    }
}