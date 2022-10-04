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
        Schema::create('pickup_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id');
            $table->boolean('ambil')->default(false);
            $table->text('alamat_ambil');
            $table->boolean('antar')->default(false);
            $table->text('alamat_antar');
            $table->boolean('terambil')->default(false);
            $table->boolean('terantar')->default(false);
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
        Schema::dropIfExists('pickup_deliveries');
    }
};
