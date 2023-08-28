<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Day::create([
            'name' => 'Senin',
            'slug' => 'senin',
            'date_start' => '2023-01-01',
            'date_end' => '2023-01-01'
        ]);

        Day::create([
            'name' => 'Selasa',
            'slug' => 'selasa',
            'date_start' => '2023-01-01',
            'date_end' => '2023-01-01'
        ]);
        Day::create([
            'name' => 'Rabu',
            'slug' => 'rabu',
            'date_start' => '2023-01-01',
            'date_end' => '2023-01-01'
        ]);
        Day::create([
            'name' => 'Kamis',
            'slug' => 'kamis',
            'date_start' => '2023-01-01',
            'date_end' => '2023-01-01'
        ]);
        Day::create([
            'name' => 'Jumat',
            'slug' => 'jumat',
            'date_start' => '2023-01-01',
            'date_end' => '2023-01-01'
        ]);
        Day::create([
            'name' => 'Sabtu',
            'slug' => 'sabtu',
            'date_start' => '2023-01-01',
            'date_end' => '2023-01-01'
        ]);
        Day::create([
            'name' => 'Minggu',
            'slug' => 'minggu',
            'date_start' => '2023-01-01',
            'date_end' => '2023-01-01'
        ]);
        Day::create([
            'name' => 'Senin - Selasa',
            'slug' => 'ss01',
            'date_start' => '2023-01-01',
            'date_end' => '2023-01-02'
        ]);

        Day::create([
            'name' => 'Rabu - Jumat',
            'slug' => 'rj01',
            'date_start' => '2023-01-02',
            'date_end' => '2023-01-03'
        ]);
        Day::create([
            'name' => 'Sabtu - Minggu',
            'slug' => 'sm01',
            'date_start' => '2023-01-03',
            'date_end' => '2023-01-04'
        ]);
        Day::create([
            'name' => 'Senin - Selasa',
            'slug' => 'ss02',
            'date_start' => '2023-01-04',
            'date_end' => '2023-01-05'
        ]);
        Day::create([
            'name' => 'Rabu - Jumat',
            'slug' => 'rj02',
            'date_start' => '2023-01-05',
            'date_end' => '2023-01-06'
        ]);
        Day::create([
            'name' => 'Sabtu - Minggu',
            'slug' => 'sm02',
            'date_start' => '2023-01-06',
            'date_end' => '2023-01-07'
        ]);
        Day::create([
            'name' => 'Senin - Selasa',
            'slug' => 'ss03',
            'date_start' => '2023-01-07',
            'date_end' => '2023-01-08'
        ]);
    }
}
