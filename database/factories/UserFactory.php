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
     * Add fake user details.
     */
    public function fake(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email' => $this->faker->unique()->safeEmail(),
            ];
        });
    }

    /**
     * Administrator user.
     */
    public function administrator(): static
    {
        return $this->state([
            'email' => 'adithyanc149@gmail.com',
            'is_admin' => true,
        ]);
    }
}
