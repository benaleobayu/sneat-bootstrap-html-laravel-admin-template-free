<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


// @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pelanggan>;

class pelangganFactory extends Factory
{
    // protected $model = pelangganFactory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'regencies_id' => $this->faker->numberBetween(1, 49),
            'notes' => $this->faker->sentence(5),
            'type' => $this->faker->randomElement(['c','p'])
            
        ];
    }
}
