<?php

namespace Database\Seeders;

use App\Models\Data\JenisRewash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisRewashSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisRewash::create([
            'keterangan' => 'Masih Kotor'
        ], [
            'keterangan' => 'Kurang Wangi'
        ], [
            'keterangan' => 'Masih Setengah Kering'
        ], [
            'keterangan' => 'Salah Parfum'
        ]);
    }
}
