<?php

namespace Database\Factories;

use App\Models\Song;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SongFactory extends Factory
{
    protected $model = Song::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'photo' => 'https://picsum.photos/id/237/200/300',
            'genre' => $this->faker->randomElement(['pop', 'rock', 'jazz', 'rap', 'metal']),
            'album' => $this->faker->randomElement(['summer', 'winter', 'autumn', 'spring']),
            'singer' => $this->faker->randomElement(['Drake', 'Ariana Grande', 'Eminem']),
            'description' => $this->faker->text(),
        ];
    }
}
