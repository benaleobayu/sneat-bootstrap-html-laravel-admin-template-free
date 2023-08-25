<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

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
        $user1 = User::create(array_merge([
            'name' => 'Priska',
            'username' => 'priska',
            'email' => 'priska@test.com'
        ],$defaultValue));
        $user2 = User::create(array_merge([
            'name' => 'Eka',
            'username' => 'eka',
            'email' => 'eka@test.com'
        ],$defaultValue));
        $user3 = User::create(array_merge([
            'name' => 'Beno',
            'username' => 'beno',
            'email' => 'beno@test.com'
        ],$defaultValue));

        $role1 = Role::create(['name' => 'Super Admin', 'guard_name' => 'web']);
        Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        Role::create(['name' => 'Officer', 'guard_name' => 'web']);
        Role::create(['name' => 'User', 'guard_name' => 'web']);

        $user1->assignRole('Admin');
        $user2->assignRole('Officer');
        $user3->assignRole('User');
        $admins->assignRole('Super Admin');

        // $role1->givePermissionTo(Permission::all());
    }
}
