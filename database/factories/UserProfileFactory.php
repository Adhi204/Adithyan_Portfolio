<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    /**
     * Define the model's fake state.
     */
    public function fake(): static
    {
        return $this->state(function () {
            return [
                'name' => substr($this->faker->name(), 0, 100),
            ];
        });
    }

    /**
     * admin profile.
     */
    public function admin(): static
    {
        return $this->state([
            'name' => 'Adithyan',
            'designation' => 'Software Engineer',
            'about' => 'This is a test after login change this',
            'location' => 'Kannur',
            'phone' => '1234567895',
            'email' => 'adithyanc149@gmail.com',
        ]);
    }
}
