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

            $admins->givePermissionTo('Read.Customers');
            $admins->givePermissionTo('Create.Customers');
            $admins->givePermissionTo('Edit.Customers');
            $admins->givePermissionTo('Delete.Customers');

            $admins->givePermissionTo('Read.Langganan');
            $admins->givePermissionTo('Create.Langganan');
            $admins->givePermissionTo('Edit.Langganan');
            $admins->givePermissionTo('Delete.Langganan');

            $admins->givePermissionTo('Read.DataRiders');
            $admins->givePermissionTo('Create.DataRiders');
            $admins->givePermissionTo('Edit.DataRiders');
            $admins->givePermissionTo('Delete.DataRiders');
            
            $admins->givePermissionTo('Read.DataOrders');
            $admins->givePermissionTo('Create.DataOrders');
            $admins->givePermissionTo('Edit.DataOrders');
            $admins->givePermissionTo('Delete.DataOrders');
            
            $admins->givePermissionTo('Read.PaymentRiders');
            $admins->givePermissionTo('Create.PaymentRiders');
            $admins->givePermissionTo('Edit.PaymentRiders');
            $admins->givePermissionTo('Delete.PaymentRiders');
            
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

            $admins->givePermissionTo('Read.Regency');
            $admins->givePermissionTo('Create.Regency');
            $admins->givePermissionTo('Edit.Regency');
            $admins->givePermissionTo('Delete.Regency');

            $admins->givePermissionTo('Read.Flower');
            $admins->givePermissionTo('Create.Flower');
            $admins->givePermissionTo('Edit.Flower');
            $admins->givePermissionTo('Delete.Flower');

            $admins->givePermissionTo('Read.Day');
            $admins->givePermissionTo('Create.Day');
            $admins->givePermissionTo('Edit.Day');
            $admins->givePermissionTo('Delete.Day');
    }
}
