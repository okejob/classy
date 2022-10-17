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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('outlet_input_id')
                ->nullable()
                ->constrained('outlets', 'id')
                ->cascadeOnDelete();
            $table->foreignId('cashier_id')
                ->nullable()
                ->constrained('users', 'id')
                ->cascadeOnDelete();
            $table->foreignId('pickup_delivery_id')->nullable();
            $table->foreignId('parfum_id')->nullable();
            $table->integer('total_bobot')->default(0);
            $table->integer('jumlah_bucket')->default(0);
            $table->integer('subtotal')->default(0);
            $table->integer('diskon')->default(0);
            $table->boolean('diskon_member')->default(false);
            $table->integer('grand_total')->default(0);
            $table->boolean('lunas')->default(false);
            $table->integer('total_terbayar')->default(0);
            $table->string('status')->default('cashier');
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('transaksis');
    }
};
