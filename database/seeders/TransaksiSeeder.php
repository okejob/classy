<?php

namespace Database\Seeders;

use App\Models\Transaksi\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaksi::create([
            'kode' => 'Trans-00001',
            'pelanggan_id' => 2,
            'outlet_id' => 1,
            'cashier_id' => 1,
            'parfum_id' => 1,
            'status' => 'draft',
            'modified_by' => 1,
        ]);
    }
}
