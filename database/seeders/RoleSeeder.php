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

            'menu_item',
            'insert_item',
            'delete_item',

            'menu_outlet',
            'insert_outlet',
            'delete_outlet',

            'menu_kategori',
            'insert_kategori',
            'delete_kategori',

            'menu_parfum',
            'insert_parfum',
            'delete_parfum',

            'menu_pelanggan',
            'insert_pelanggan',
            'delete_pelanggan',

            'menu_pengeluaran',
            'insert_pengeluaran',
            'delete_pengeluaran',
        ]);
        Role::create(['name' => 'supervisor']);
        Role::create(['name' => 'operator']);
        Role::create(['name' => 'produksi_cuci']);
        Role::create(['name' => 'produksi_setrika']);
        Role::create(['name' => 'delivery']);
        Role::create(['name' => 'customer']);
    }
}
