<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultValue = ([
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(16)
        ]);
        
        $admins = User::create(array_merge([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'admin@test.com'
        ],$defaultValue));
    }
}
