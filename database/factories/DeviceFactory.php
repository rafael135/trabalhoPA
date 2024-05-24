<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::all()->random();

        return [
            "user_id" => $user->id,
            "consumption_per_hour" => $this->faker->randomFloat(2, 50, 300),
            "hours_per_day" => $this->faker->randomNumber(1),
            "brand" => $this->faker->company(),
            "name" => $this->faker->name()
        ];
    }
}
