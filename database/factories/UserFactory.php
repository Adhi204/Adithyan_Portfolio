<?php

namespace Database\Factories;

use App\Library\Classes\Factory;
use Illuminate\Support\Facades\Hash;

use function Symfony\Component\Clock\now;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'password' => Hash::make('password'),
        ];
    }

    /**
     * Administrator user.
     */
    public function administrator(): static
    {
        return $this->state([
            'email' => 'adithyanc149@gmail.com',
            'email_verified_at' => now(),
        ]);
    }
}
