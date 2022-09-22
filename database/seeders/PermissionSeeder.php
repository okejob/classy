<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Menu
        Permission::create(['name' => 'menu_item']);
        Permission::create(['name' => 'menu_pengeluaran']);
        Permission::create(['name' => 'menu_rewash']);

        //setting
        Permission::create(['name' => 'setting_karyawan']);
        Permission::create(['name' => 'setting_outlet']);
        Permission::create(['name' => 'setting_paket']);

        //Parfum
        Permission::create(['name' => 'menu_parfum']);
        Permission::create(['name' => 'insert_parfum']);
        Permission::create(['name' => 'delete_parfum']);

        //Pelanggan
        Permission::create(['name' => 'menu_pelanggan']);
        Permission::create(['name' => 'insert_pelanggan']);
        Permission::create(['name' => 'delete_pelanggan']);

        //Kategori
        Permission::create(['name' => 'menu_kategori']);
        Permission::create(['name' => 'insert_kategori']);
        Permission::create(['name' => 'delete_kategori']);
    }
}
