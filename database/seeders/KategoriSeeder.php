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
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Aksesoris Mobil',
            'deskripsi' => 'Segala Jenis Aksesoris Mobil',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Aksesoris Rumah',
            'deskripsi' => 'Segala Jenis Aksesoris Rumah',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Atasan',
            'deskripsi' => 'Segala Jenis Atasan',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Bahan Kulit',
            'deskripsi' => 'Segala Jenis Bahan Kulit',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Baju Rohani',
            'deskripsi' => 'Segala Jenis Baju Rohani',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Bahan Set',
            'deskripsi' => 'Segala Jenis Baju Set',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Bawahan',
            'deskripsi' => 'Segala Jenis Bawahan',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Bedsheet',
            'deskripsi' => 'Segala Jenis Bedsheet',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Bucket',
            'deskripsi' => 'Hanya untuk Paket Bucket',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Corporate',
            'deskripsi' => 'Hanya untuk Corporate',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Lain Lain',
            'deskripsi' => 'Segala Jenis Lainnya',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Membership',
            'deskripsi' => 'Hanya untuk Member',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Pakaian Pesta',
            'deskripsi' => 'Segala Jenis Pakaian Pesta',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Perlengkapan Bayi',
            'deskripsi' => 'Segala Jenis Perlengkapan Bayi',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Promo',
            'deskripsi' => 'Hanya untuk Promo',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Sepatu/Sandal',
            'deskripsi' => 'Segala Jenis Sepatu / Sandal',
            'user_id' => 1
        ]);

        Kategori::create([
            'nama' => 'Tas',
            'deskripsi' => 'Segala Jenis Tas',
            'user_id' => 1
        ]);
    }
}
