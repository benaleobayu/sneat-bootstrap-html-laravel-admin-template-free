<?php

namespace Database\Seeders;

use App\Models\Langganan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanggananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Langganan::factory()->count(15)->create();
    }
}
