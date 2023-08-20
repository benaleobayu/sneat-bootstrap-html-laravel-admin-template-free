<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            $permission = Permission::create(['name' => 'Read.Customers']);
            $permission = Permission::create(['name' => 'Create.Customers']);
            $permission = Permission::create(['name' => 'Edit.Customers']);
            $permission = Permission::create(['name' => 'Delete.Customers']);

            $permission = Permission::create(['name' => 'Read.Langganan']);
            $permission = Permission::create(['name' => 'Create.Langganan']);
            $permission = Permission::create(['name' => 'Edit.Langganan']);
            $permission = Permission::create(['name' => 'Delete.Langganan']);

            $permission = Permission::create(['name' => 'Read.DataRiders']);
            $permission = Permission::create(['name' => 'Create.DataRiders']);
            $permission = Permission::create(['name' => 'Edit.DataRiders']);
            $permission = Permission::create(['name' => 'Delete.DataRiders']);
            
            $permission = Permission::create(['name' => 'Read.DataOrders']);
            $permission = Permission::create(['name' => 'Create.DataOrders']);
            $permission = Permission::create(['name' => 'Edit.DataOrders']);
            $permission = Permission::create(['name' => 'Delete.DataOrders']);
            
            $permission = Permission::create(['name' => 'Read.PaymentRiders']);
            $permission = Permission::create(['name' => 'Create.PaymentRiders']);
            $permission = Permission::create(['name' => 'Edit.PaymentRiders']);
            $permission = Permission::create(['name' => 'Delete.PaymentRiders']);
            
            $permission = Permission::create(['name' => 'Read.Invoice']);
            $permission = Permission::create(['name' => 'Create.Invoice']);
            $permission = Permission::create(['name' => 'Edit.Invoice']);
            $permission = Permission::create(['name' => 'Delete.Invoice']);
            
            $permission = Permission::create(['name' => 'Read.Dokumentasi']);
            $permission = Permission::create(['name' => 'Create.Dokumentasi']);
            $permission = Permission::create(['name' => 'Edit.Dokumentasi']);
            $permission = Permission::create(['name' => 'Delete.Dokumentasi']);

            $permission = Permission::create(['name' => 'Read.Admin']);
            $permission = Permission::create(['name' => 'Create.Admin']);
            $permission = Permission::create(['name' => 'Edit.Admin']);
            $permission = Permission::create(['name' => 'Delete.Admin']);

            $permission = Permission::create(['name' => 'Read.Roles']);
            $permission = Permission::create(['name' => 'Create.Roles']);
            $permission = Permission::create(['name' => 'Edit.Roles']);
            $permission = Permission::create(['name' => 'Delete.Roles']);

            $permission = Permission::create(['name' => 'Read.Regency']);
            $permission = Permission::create(['name' => 'Create.Regency']);
            $permission = Permission::create(['name' => 'Edit.Regency']);
            $permission = Permission::create(['name' => 'Delete.Regency']);

            $permission = Permission::create(['name' => 'Read.Flower']);
            $permission = Permission::create(['name' => 'Create.Flower']);
            $permission = Permission::create(['name' => 'Edit.Flower']);
            $permission = Permission::create(['name' => 'Delete.Flower']);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
