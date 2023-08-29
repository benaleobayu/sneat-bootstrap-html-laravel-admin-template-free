<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pesanan>
 */
class PesananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'regencies_id' =>$this->faker->numberBetween('1', '49'),
            'day_id' =>$this->faker->numberBetween('8', '14'),
            'notes' => $this->faker->paragraph(30),
            'range' => $this->faker->numberBetween(6, 49),
            'rider' => $this->faker->randomElement(['Drajat', 'Rian', 'Dedi']),
            'route' => $this->faker->numberBetween(1,4),
            // 'flower_id' => $this->faker->numberBetween('1', '12'),
            // 'total' => $this->faker->numberBetween('1', '4'),
        ];
    }
}
