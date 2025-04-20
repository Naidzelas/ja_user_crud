<?php

namespace Database\Factories\Replacables;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Replacables\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->numerify('#########'),
            'role_id' => 1,
            'birth_date' => $this->faker->date(),
            'employed_at' => $this->faker->dateTime(),
            'terminated_at' => null,
        ];
    }
}
