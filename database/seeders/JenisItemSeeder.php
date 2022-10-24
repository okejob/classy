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
        JenisItem::create([
            'nama' => 'CELANA JEANS PANJANG',
            'kategori_id' => 10,
            'unit' => 'PCS',
            'bobot_bucket' => 2.0,
            'harga_premium' => 0,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => false,
            'status_bucket' => true,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'CELANA JEANS PENDEK',
            'kategori_id' => 10,
            'unit' => 'PCS',
            'bobot_bucket' => '2.0',
            'harga_premium' => 0,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => false,
            'status_bucket' => true,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'DASTER',
            'kategori_id' => 10,
            'unit' => 'PCS',
            'bobot_bucket' => '2.0',
            'harga_premium' => 0,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => false,
            'status_bucket' => true,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'HANDUK BESAR',
            'kategori_id' => 10,
            'unit' => 'PCS',
            'bobot_bucket' => '2.0',
            'harga_premium' => 0,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => false,
            'status_bucket' => true,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'HANDUK KECIL',
            'kategori_id' => 10,
            'unit' => 'PCS',
            'bobot_bucket' => '1.0',
            'harga_premium' => 0,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => false,
            'status_bucket' => true,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'HEADBAND',
            'kategori_id' => 10,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 0,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => false,
            'status_bucket' => true,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'JUBAH TOGA VITA SCHOOL',
            'kategori_id' => 10,
            'unit' => 'PCS',
            'bobot_bucket' => '2.0',
            'harga_premium' => 0,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => false,
            'status_bucket' => true,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'KAOS DALAM',
            'kategori_id' => 10,
            'unit' => 'PCS',
            'bobot_bucket' => '0.5',
            'harga_premium' => 0,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => false,
            'status_bucket' => true,
            'status_kilo' => false,
            'beban_produksi' => '0.5',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'KEMBEN',
            'kategori_id' => 10,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 0,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => false,
            'status_bucket' => true,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'SAPU TANGAN',
            'kategori_id' => 10,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 0,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => false,
            'status_bucket' => true,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'SARUNG BALI',
            'kategori_id' => 10,
            'unit' => 'PCS',
            'bobot_bucket' => '1.0',
            'harga_premium' => 0,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => false,
            'status_bucket' => true,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'VITASCH JUBAH',
            'kategori_id' => 10,
            'unit' => 'PCS',
            'bobot_bucket' => '2.0',
            'harga_premium' => 0,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => false,
            'status_bucket' => true,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'VITASCH SLEBER',
            'kategori_id' => 10,
            'unit' => 'PCS',
            'bobot_bucket' => '1.0',
            'harga_premium' => 0,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => false,
            'status_bucket' => true,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => '3 BEDCOVER ALLSIZE',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 190000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '20.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'AUDELIA BEDSET BESAR(1BCd,1SPRd,2SBTL,2SGLG)',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 42000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'AUDELIA BEDSET KECIL(1BCs,1SPRs,1SBTL,1SGLG)',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 31000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'AUDELIA FULL SET(1BCd,1BCs,3SBTL,3SGLG)',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 58000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'AUDELIA SEPREI BESAR(3 SPRd,6SBTL,6SGLG)',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 33000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'AUDELIA SEPREI KECIL(3 SPRs,3SBTL,3SGLG)',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 28000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BABY CAR CHAIR',
            'kategori_id' => 15,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 98000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '20.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BABY STROLLER',
            'kategori_id' => 15,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 98000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BAJU GAMIS',
            'kategori_id' => 6,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 30000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BAJU KARATE',
            'kategori_id' => 4,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 40000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '1.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BAJU KOKO',
            'kategori_id' => 6,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 20000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BAJU PENGANTIN JAWA',
            'kategori_id' => 14,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 180000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BAJU RENANG',
            'kategori_id' => 4,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 28000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BANDANA',
            'kategori_id' => 1,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 17000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '1.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BANTAL',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 45000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BANTAL BONEKA',
            'kategori_id' => 3,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 50000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BANTAL BULU ANGSA',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 58000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BANTAL SOFA JUMBO (>60CM)',
            'kategori_id' => 3,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 110000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BANTAL SOFA L(30CM-60CM)',
            'kategori_id' => 3,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 53000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BANTAL SOFA S (<30CM)',
            'kategori_id' => 3,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 40000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BANTAL SOFA TIPIS',
            'kategori_id' => 3,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 35000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BANTAL/GULING BAYI',
            'kategori_id' => 15,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 25000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BED COVER DOUBLE',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 68000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '15.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BED COVER JUMBO ( > 2,2M )',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 95000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '20.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BED COVER SINGLE',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 45000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BEDCOVER 2 LAYER',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 125000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '22.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BEDCOVER BAYI',
            'kategori_id' => 15,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 38000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BEDCOVER SUTRA',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 115000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BEDSHEET BESAR (1BC,1SP,2BTL,2GLG)',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 115000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => false,
        ]);

        JenisItem::create([
            'nama' => 'BLAZER / JAS',
            'kategori_id' => 4,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 43000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BLOUSE (SELUTUT)',
            'kategori_id' => 4,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 33000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BLOUSE ANAK',
            'kategori_id' => 4,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 16000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '3.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BLOUSE BATIK',
            'kategori_id' => 4,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 39000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BLOUSE PESTA',
            'kategori_id' => 14,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 55000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BLOUSE PESTA ANAK',
            'kategori_id' => 14,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 38000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BONEKA BESAR (40-60CM)',
            'kategori_id' => 3,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 50000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BONEKA JUMBO (60CM <)',
            'kategori_id' => 3,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 95000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '15.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BONEKA KECIL (<20CM)',
            'kategori_id' => 3,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 15000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BONEKA SEDANG (20-40CM)',
            'kategori_id' => 3,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 28000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BORC BAJU',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 5000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => false,
        ]);

        JenisItem::create([
            'nama' => 'BORC CELANA',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 5000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => false,
        ]);

        JenisItem::create([
            'nama' => 'BORC DEKER KAIN',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 3000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => false,
        ]);

        JenisItem::create([
            'nama' => 'BORC HANDUK KECIL',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 3000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => false,
        ]);

        JenisItem::create([
            'nama' => 'BORC JAS',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 10000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => false,
        ]);

        JenisItem::create([
            'nama' => 'BORC PAKET LENGKAP',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 177000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => false,
        ]);

        JenisItem::create([
            'nama' => 'BORC SEPREI BESAR',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 15000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => false,
        ]);

        JenisItem::create([
            'nama' => 'BORC SEPREI KECIL',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 10000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => false,
        ]);

        JenisItem::create([
            'nama' => 'BORC TAPLAK BESAR',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 10000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => false,
        ]);

        JenisItem::create([
            'nama' => 'BORC TAPLAK KECIL',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 8000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => false,
        ]);

        JenisItem::create([
            'nama' => 'BRA / CD',
            'kategori_id' => 4,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 15000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '1.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BRA ANAK',
            'kategori_id' => 4,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 11000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '3.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BUMPER BAYI (1BJ)',
            'kategori_id' => 15,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 28000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BUMPER BAYI (2 PCS)',
            'kategori_id' => 15,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 35000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '7.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'BUMPER BAYI (4 PCS)',
            'kategori_id' => 15,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 55000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'CARDIGAN',
            'kategori_id' => 4,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 32000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'CELANA BALAP',
            'kategori_id' => 8,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 125000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'CELANA DALAM ANAK',
            'kategori_id' => 8,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 13000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '2.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'CELANA KARATE',
            'kategori_id' => 8,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 35000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'CELANA KULIT',
            'kategori_id' => 5,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 99000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'CELANA PANJANG',
            'kategori_id' => 8,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 35000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'CELANA PANJANG ANAK',
            'kategori_id' => 8,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 18000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '3.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'CELANA PENDEK',
            'kategori_id' => 8,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 25000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'CELANA PENDEK ANAK',
            'kategori_id' => 8,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 15000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '2.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'CELEMEK MAKAN ANAK',
            'kategori_id' => 15,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 17000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '1.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'COVER BEDCOVER',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 70000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'COVER BEDCOVER SMALL',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 55000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '2.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'COVER DADA',
            'kategori_id' => 12,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 40000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '3.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'COVER GITAR',
            'kategori_id' => 3,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 45000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'COVER JOK MOBIL (4PC)',
            'kategori_id' => 2,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 110000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '7.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'COVER JOK MOBIL(8PC)',
            'kategori_id' => 2,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 200000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'COVER KASUR BAYI',
            'kategori_id' => 15,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 110000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '8.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'COVER KASUR LARGE',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 225000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '20.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'COVER KASUR SMALL',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 150000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '15.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'COVER TOPPER',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 52000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '2.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'DASI',
            'kategori_id' => 1,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 18000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '1.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'DEKER /BIJI',
            'kategori_id' => 1,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 8000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '1.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'DEKER KAKI',
            'kategori_id' => 1,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 20000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '2.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'DOMPET PESTA',
            'kategori_id' => 18,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 85000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '4.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'DOMPET WANITA',
            'kategori_id' => 18,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 30000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'DUDUKAN STROLLER',
            'kategori_id' => 15,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 30000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '7.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'GAUN PENGANTIN',
            'kategori_id' => 14,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 290000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '50.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'GAUN PENGANTIN EKOR',
            'kategori_id' => 14,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 380000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '60.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'GAUN PESTA ANAK',
            'kategori_id' => 14,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 42000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '7.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'GAUN PESTA BESAR',
            'kategori_id' => 14,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 110000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '15.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'GAUN PESTA PANJANG',
            'kategori_id' => 14,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 75000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => false,
        ]);

        JenisItem::create([
            'nama' => 'GAUN PESTA STANDAR',
            'kategori_id' => 14,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 80000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'GENDONGAN BAYI',
            'kategori_id' => 15,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 45000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'GORDYN TEBAL(/M2)',
            'kategori_id' => 3,
            'unit' => 'MTR',
            'bobot_bucket' => 0.0,
            'harga_premium' => 18000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'GORDYN TIPIS/VITRAGE (/M2)',
            'kategori_id' => 3,
            'unit' => 'MTR',
            'bobot_bucket' => 0.0,
            'harga_premium' => 16000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '20.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'GULING',
            'kategori_id' => 9,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 40000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '20.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'HANDUK',
            'kategori_id' => 3,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 25000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '5.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'HANDUK BAJU',
            'kategori_id' => 3,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 38000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '7.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'HELM RACING',
            'kategori_id' => 1,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 48000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => '10.0',
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'HIPOXI HANDUK BESAR',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 1650,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'HIPOXI HANDUK KECIL',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 1350,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => true,
        ]);

        JenisItem::create([
            'nama' => 'HoL Gaun panjang',
            'kategori_id' => 11,
            'unit' => 'PCS',
            'bobot_bucket' => 0.0,
            'harga_premium' => 20000,
            'harga_bucket' => 0,
            'harga_kilo' => 0,
            'status_premium' => true,
            'status_bucket' => false,
            'status_kilo' => false,
            'beban_produksi' => 0.0,
            'status_item' => false,
        ]);
    }
}
