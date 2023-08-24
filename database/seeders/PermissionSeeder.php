<?php

namespace Database\Seeders;

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
            $permission = Permission::create(['name' => 'Read.Pelanggan']);
            $permission = Permission::create(['name' => 'Create.Pelanggan']);
            $permission = Permission::create(['name' => 'Edit.Pelanggan']);
            $permission = Permission::create(['name' => 'Delete.Pelanggan']);

            $permission = Permission::create(['name' => 'Read.Langganan']);
            $permission = Permission::create(['name' => 'Create.Langganan']);
            $permission = Permission::create(['name' => 'Edit.Langganan']);
            $permission = Permission::create(['name' => 'Delete.Langganan']);

            $permission = Permission::create(['name' => 'Read.Kurir']);
            $permission = Permission::create(['name' => 'Create.Kurir']);
            $permission = Permission::create(['name' => 'Edit.Kurir']);
            $permission = Permission::create(['name' => 'Delete.Kurir']);
            
            $permission = Permission::create(['name' => 'Read.Pesanan']);
            $permission = Permission::create(['name' => 'Create.Pesanan']);
            $permission = Permission::create(['name' => 'Edit.Pesanan']);
            $permission = Permission::create(['name' => 'Delete.Pesanan']);
            
            $permission = Permission::create(['name' => 'Read.Pembayaran']);
            $permission = Permission::create(['name' => 'Create.Pembayaran']);
            $permission = Permission::create(['name' => 'Edit.Pembayaran']);
            $permission = Permission::create(['name' => 'Delete.Pembayaran']);
            
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

            $permission = Permission::create(['name' => 'Read.Daerah']);
            $permission = Permission::create(['name' => 'Create.Daerah']);
            $permission = Permission::create(['name' => 'Edit.Daerah']);
            $permission = Permission::create(['name' => 'Delete.Daerah']);

            $permission = Permission::create(['name' => 'Read.Bunga']);
            $permission = Permission::create(['name' => 'Create.Bunga']);
            $permission = Permission::create(['name' => 'Edit.Bunga']);
            $permission = Permission::create(['name' => 'Delete.Bunga']);

            $permission = Permission::create(['name' => 'Read.Hari']);
            $permission = Permission::create(['name' => 'Create.Hari']);
            $permission = Permission::create(['name' => 'Edit.Hari']);
            $permission = Permission::create(['name' => 'Delete.Hari']);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
