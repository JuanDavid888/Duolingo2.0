<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $roles = Role::all();

        // Validation to prevent nulls
        if ($users->isEmpty() || $roles->isEmpty()) {
            $this->command->warn("There are no users or roles to associate.");
            return;
        }

        foreach ($users as $user) {
            // Rol assigned to a random user
            $randomRole = $roles->random(1)->pluck('id')->toArray();

            // Insertion with relation 'roles' from the User table
            $user->roles()->syncWithoutDetaching($randomRole);
        }

        $this->command->info("Roles successfully associated with users.");
    }
}