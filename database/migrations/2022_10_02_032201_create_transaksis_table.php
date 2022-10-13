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
            $table->foreignId('pelanggan_id');

            $table->foreignId('outlet_input_id')
                ->nullable()
                ->constrained('outlets', 'id')
                ->cascadeOnDelete();
            $table->foreignId('cashier_id')
                ->nullable()
                ->constrained('users', 'id')
                ->cascadeOnDelete();

            $table->foreignId('pickup_delivery_id')->nullable();
            $table->boolean('ambil_di_outlet')->default(true);
            $table->foreignId('outlet_ambil_id')
                ->nullable()
                ->constrained('outlets', 'id')
                ->cascadeOnDelete();

            $table->foreignId('parfum_id');
            $table->integer('total_bobot');
            $table->integer('jumlah_bucket');
            $table->integer('subtotal');
            $table->integer('diskon');
            $table->boolean('diskon_member')->default(false);
            $table->integer('grand_total');
            $table->boolean('lunas');
            $table->integer('total_terbayar');
            $table->string('status');
            $table->text('catatan');
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
