<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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
        $admin->givePermissionTo(Permission::all());

        Role::create(['name' => 'supervisor']);
        Role::create(['name' => 'operator']);

        $produksi_cuci = Role::create(['name' => 'produksi_cuci']);
        $produksi_cuci->syncPermissions([
            'Melihat Detail Item Transaksi',
            'Melihat Detail Daftar Catatan Item',
            'Melihat Detail Catatan Item',
            'Membuat Catatan Item',

            'Membuka Menu Hub Cuci',
            'Mengambil Tugas Cuci',
            'Mengurangi Tugas Cuci',

            'Membuka Menu Rewash',
            'Mengganti Status Rewash'
        ]);

        $produksi_setrika = Role::create(['name' => 'produksi_setrika']);
        $produksi_setrika->syncPermissions([
            'Melihat Detail Item Transaksi',
            'Melihat Detail Daftar Catatan Item',
            'Melihat Detail Catatan Item',
            'Membuat Catatan Item',

            'Membuka Menu Hub Setrika',
            'Mengambil Tugas Setrika',
            'Mengurangi Tugas Setrika',

            'Membuka Menu Rewash',
            'Menambah Rewash',
            'Mengganti Status Rewash',
        ]);

        $delivery = Role::create(['name' => 'delivery']);
        $delivery->syncPermissions([
            'Membuka Menu Pickup Delivery',
            'Melihat Detail Pickup Delivery',
            'Membuat Pickup Delivery',
            'Mengubah Data Pickup Delivery',
            'Mengganti Status Selesai Pickup Delivery',

            'Membuka Menu Transaksi',
            'Melihat Detail Transaksi',
            'Menambahkan Item Ke Transaksi',
            'Mengubah Data Transaksi',

            'Melihat Detail Item Transaksi',
            'Membuat Item Transaksi',
            'Mengubah Data Item Transaksi',
            'Menghapus Item Transaksi',
        ]);
    }
}
