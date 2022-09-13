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
        Role::create(['name' => 'administrator']);
        Role::create(['name' => 'admin_pusat']);
        Role::create(['name' => 'admin_cabang']);
        Role::create(['name' => 'pegawai']);
        Role::create(['name' => 'driver']);
    }
}
