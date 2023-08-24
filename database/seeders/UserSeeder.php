<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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

        $role = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $role = Role::create(['name' => 'Officer', 'guard_name' => 'web']);
        $role = Role::create(['name' => 'User', 'guard_name' => 'web']);

     

        $user1->assignRole('Officer');
        $user2->assignRole('Officer');
        $user3->assignRole('User');
        $admins->assignRole('Admin');

            $admins->givePermissionTo('Read.Pelanggan');
            $admins->givePermissionTo('Create.Pelanggan');
            $admins->givePermissionTo('Edit.Pelanggan');
            $admins->givePermissionTo('Delete.Pelanggan');

            $admins->givePermissionTo('Read.Langganan');
            $admins->givePermissionTo('Create.Langganan');
            $admins->givePermissionTo('Edit.Langganan');
            $admins->givePermissionTo('Delete.Langganan');

            $admins->givePermissionTo('Read.Kurir');
            $admins->givePermissionTo('Create.Kurir');
            $admins->givePermissionTo('Edit.Kurir');
            $admins->givePermissionTo('Delete.Kurir');
            
            $admins->givePermissionTo('Read.Pesanan');
            $admins->givePermissionTo('Create.Pesanan');
            $admins->givePermissionTo('Edit.Pesanan');
            $admins->givePermissionTo('Delete.Pesanan');
            
            $admins->givePermissionTo('Read.Pembayaran');
            $admins->givePermissionTo('Create.Pembayaran');
            $admins->givePermissionTo('Edit.Pembayaran');
            $admins->givePermissionTo('Delete.Pembayaran');
            
            $admins->givePermissionTo('Read.Invoice');
            $admins->givePermissionTo('Create.Invoice');
            $admins->givePermissionTo('Edit.Invoice');
            $admins->givePermissionTo('Delete.Invoice');
            
            $admins->givePermissionTo('Read.Dokumentasi');
            $admins->givePermissionTo('Create.Dokumentasi');
            $admins->givePermissionTo('Edit.Dokumentasi');
            $admins->givePermissionTo('Delete.Dokumentasi');

            $admins->givePermissionTo('Read.Admin');
            $admins->givePermissionTo('Create.Admin');
            $admins->givePermissionTo('Edit.Admin');
            $admins->givePermissionTo('Delete.Admin');

            $admins->givePermissionTo('Read.Roles');
            $admins->givePermissionTo('Create.Roles');
            $admins->givePermissionTo('Edit.Roles');
            $admins->givePermissionTo('Delete.Roles');

            $admins->givePermissionTo('Read.Daerah');
            $admins->givePermissionTo('Create.Daerah');
            $admins->givePermissionTo('Edit.Daerah');
            $admins->givePermissionTo('Delete.Daerah');

            $admins->givePermissionTo('Read.Bunga');
            $admins->givePermissionTo('Create.Bunga');
            $admins->givePermissionTo('Edit.Bunga');
            $admins->givePermissionTo('Delete.Bunga');

            $admins->givePermissionTo('Read.Hari');
            $admins->givePermissionTo('Create.Hari');
            $admins->givePermissionTo('Edit.Hari');
            $admins->givePermissionTo('Delete.Hari');
    }
}
