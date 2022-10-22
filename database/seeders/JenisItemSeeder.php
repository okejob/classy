<?php

namespace Database\Seeders;

use App\Models\Data\JenisItem;
use App\Models\Data\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisItem::factory(30)->create();
    }
}
