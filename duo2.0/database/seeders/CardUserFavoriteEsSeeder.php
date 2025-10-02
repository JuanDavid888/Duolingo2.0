<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Card;

class Amenityuserseeder extends Seeder
{
    public function run(): void
    {
        $users = user::all();
        $cards = Card::all();

        if ($users->isEmpty() || $cards->isEmpty()) {
            $this->command->warn('No hay nada para asignar.');
            return;
        }

        foreach ($users as $room) {
            $randomcards = $cards->random(rand(1, 3))->pluck('id')->toArray();

            $room->cards()->syncWithoutDetaching($randomcards);
        }

        $this->command->info("card asignadas a todas las users correctamente.");
    }
}
