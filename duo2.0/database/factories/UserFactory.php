<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),  // Establecemos la verificación del correo
            'password' => static::$password ??= Hash::make('password'),  // Contraseña por defecto
            'remember_token' => Str::random(10),  // Token de recordatorio
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,  // Correo no verificado
        ]);
    }

    /**
     * Asignar roles al usuario.
     * 
     * @param  array  $roleNames
     * @return static
     */
    public function withRoles(array $roleNames = ['viewer'])
    {
        return $this->afterCreating(function (User $user) use ($roleNames) {
            // Recorre los nombres de los roles proporcionados
            foreach ($roleNames as $name) {
                // Buscar o crear el rol
                $role = Role::firstOrCreate(
                    ['name' => $name], // Buscar por nombre
                    ['label' => ucfirst($name) . ' Role'] // Si no existe, crea el rol
                );

                // Asociar el rol al usuario
                if ($role) {
                    $user->role()->syncWithoutDetaching([$role->id]);
                }
            }
        });
    }
}
