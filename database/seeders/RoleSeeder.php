<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'administrator']);
        $admin->givePermissionTo([

            'menu_pengeluaran',
            'menu_rewash',

            'menu_karyawan',
            'menu_paket',

            'menu_jenis_item',
            'show_jenis_item',
            'insert_jenis_item',
            'update_jenis_item',
            'delete_jenis_item',

            'menu_outlet',
            'show_outlet',
            'insert_outlet',
            'update_outlet',
            'delete_outlet',

            'menu_kategori',
            'show_kategori',
            'insert_kategori',
            'update_kategori',
            'delete_kategori',

            'menu_parfum',
            'show_parfum',
            'insert_parfum',
            'update_parfum',
            'delete_parfum',

            'menu_pelanggan',
            'show_pelanggan',
            'insert_pelanggan',
            'update_pelanggan',
            'delete_pelanggan',

            'menu_pengeluaran',
            'show_pengeluaran',
            'insert_pengeluaran',
            'update_pengeluaran',
            'delete_pengeluaran',

            'menu_pickup_delivery',
            'show_pickup_delivery',
            'insert_pickup_delivery',
            'update_pickup_delivery',
            'delete_pickup_delivery',

            'show_item_transaksi',
            'insert_item_transaksi',
            'update_item_transaksi',
            'delete_item_transaksi',

            'menu_transaksi_bucket',
        ]);
        Role::create(['name' => 'supervisor']);
        Role::create(['name' => 'operator']);
        Role::create(['name' => 'produksi_cuci']);
        Role::create(['name' => 'produksi_setrika']);
        Role::create(['name' => 'delivery']);
        Role::create(['name' => 'customer']);
    }
}
