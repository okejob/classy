<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerimas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pickup_delivery_id')
                ->nullable();
            $table->foreignId('transaksi_id');
            $table->boolean('ambil_di_outlet')->default(true);
            $table->foreignId('outlet_ambil_id')
                ->nullable()
                ->constrained('outlets', 'id')
                ->cascadeOnDelete();
            $table->date('tanggal_ambil_di_outlet')->nullable();
            $table->string('penerima')->nullable();
            $table->string('foto_penerima')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penerimas');
    }
};
