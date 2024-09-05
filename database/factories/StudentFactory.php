<?php

namespace Database\Factories;

use App\Filament\Resources\StudentResource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'grade_level' => $this->faker->numberBetween(StudentResource::$gradeLevelOptions[0], end(StudentResource::$gradeLevelOptions)),
        ];
    }
}
