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
            $table->foreignId('driver_ambil_id')
                ->nullable()
                ->constrained('users', 'id')
                ->cascadeOnDelete();
            $table->boolean('ambil')->default(false);
            $table->text('alamat_ambil')->nullable();
            $table->foreignId('driver_antar_id')
                ->nullable()
                ->constrained('users', 'id')
                ->cascadeOnDelete();
            $table->boolean('antar')->default(false);
            $table->text('alamat_antar')->nullable();
            $table->boolean('ambil_di_outlet')->default(true);
            $table->foreignId('outlet_ambil_id')
                ->nullable()
                ->constrained('outlets', 'id')
                ->cascadeOnDelete();
            $table->date('tanggal_ambil_di_outlet')->nullable();
            $table->boolean('terambil')->default(false);
            $table->boolean('terantar')->default(false);
            $table->string('penerima')->nullable();
            $table->string('foto_penerima')->nullable();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
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
