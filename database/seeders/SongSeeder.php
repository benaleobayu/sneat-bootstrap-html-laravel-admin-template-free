<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Song::factory(22)->create();
    }
}
