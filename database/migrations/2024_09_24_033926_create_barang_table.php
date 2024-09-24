<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pp_id');
            $table->string('nama');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->date('tanggal_diperlukan');
            $table->string('keterangan_it');
            $table->timestamps();

            $table->foreign('pp_id')->references('id')->on('permintaan_pembelian')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
