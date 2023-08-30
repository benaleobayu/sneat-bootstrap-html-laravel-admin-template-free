<?php

namespace Database\Seeders;

use App\Models\Flower;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $flowers = [
            ['code' => 'SR', 'name' => 'Mawar Merah', 'price' => '75000', 'additional' => 'false'],
            ['code' => 'A', 'name' => 'Mawar Putih', 'price' => '75000', 'additional' => 'false'],
            ['code' => 'PA', 'name' => 'Mawar Pinksweet', 'price' => '75000', 'additional' => 'false'],
            ['code' => 'P', 'name' => 'Mawar Peach', 'price' => '75000', 'additional' => 'false'],
            ['code' => 'CD', 'name' => 'Mawar Candy', 'price' => '75000', 'additional' => 'false'],
            ['code' => 'CW', 'name' => 'Mawar Ungu', 'price' => '75000', 'additional' => 'false'],
            ['code' => 'Y', 'name' => 'Mawar Kuning', 'price' => '75000', 'additional' => 'false'],
            ['code' => 'O', 'name' => 'Mawar Orange', 'price' => '75000', 'additional' => 'false'],
            ['code' => 'RV', 'name' => 'Mawar Revival', 'price' => '75000', 'additional' => 'false'],
            ['code' => 'AC', 'name' => 'Mawar Any Colors', 'price' => '75000', 'additional' => 'false'],
            ['code' => 'MC', 'name' => 'Mawar Mixed Colors', 'price' => '75000', 'additional' => 'false'],


            ['code' => 'RM-20', 'name' => 'Rangkaian Meja 20', 'price' => '150000', 'additional' => 'true'],
            ['code' => 'RM-40', 'name' => 'Rangkaian Meja 40', 'price' => '225000', 'additional' => 'true'],
            ['code' => 'RM-60', 'name' => 'Rangkaian Meja 60', 'price' => '375000', 'additional' => 'true'],
            ['code' => 'HB-20', 'name' => 'Hand Bouquet 20', 'price' => '150000', 'additional' => 'true'],
            ['code' => 'HB-40', 'name' => 'Hand Bouquet 40', 'price' => '200000', 'additional' => 'true'],
            ['code' => 'HB-60', 'name' => 'Hand Bouquet 60', 'price' => '300000', 'additional' => 'true'],
        ];
        Flower::insert($flowers);
    }
}
