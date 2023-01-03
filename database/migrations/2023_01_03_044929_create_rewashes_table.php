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
        Schema::create('rewashes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_transaksi_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('jenis_rewash_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('modified_by')
                ->constrained('users', 'id')
                ->cascadeOnDelete();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('rewashes');
    }
};
