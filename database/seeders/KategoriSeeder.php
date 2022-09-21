<?php

namespace Database\Seeders;

use App\Models\Data\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'nama' => 'Aksesoris Kaki dan Kepala',
            'deskripsi' => 'Segala Jenis Aksesoris Kaki dan Kepala',
            'status' => 'A',
        ]);

        Kategori::create([
            'nama' => 'Atasan',
            'deskripsi' => 'Segala Jenis Atasan',
            'status' => 'A',
        ]);

        Kategori::create([
            'nama' => 'Bahan Kulit',
            'deskripsi' => 'Segala Jenis Bahan Kulit',
            'status' => 'A',
        ]);

        Kategori::create([
            'nama' => 'Bawahan',
            'deskripsi' => 'Segala Jenis Bawahan',
            'status' => 'A',
        ]);
    }
}
