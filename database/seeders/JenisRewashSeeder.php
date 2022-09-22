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
            'keterangan' => 'Masih Kotor',
            'user_id' => 1
        ], [
            'keterangan' => 'Kurang Wangi',
            'user_id' => 1
        ], [
            'keterangan' => 'Masih Setengah Kering',
            'user_id' => 1
        ], [
            'keterangan' => 'Salah Parfum',
            'user_id' => 1
        ]);
    }
}
