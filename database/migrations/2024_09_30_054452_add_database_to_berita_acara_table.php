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
        Schema::table('berita_acara', function (Blueprint $table) {
            $table->string('nomor');
            $table->string('pembuat_id');
            $table->string('penerima_id');
            $table->date('tanggal_dibuat');
            $table->string('detail_barang_id');
            $table->string('pembelian_id');
            $table->string('pengecekan_id');
            $table->string('ttd_purchasing_id')->nullable();
            $table->date('purchasing_date')->nullable();
            $table->date('using_date')->nullable();
            $table->date('approved_date')->nullable();
            $table->string('status')->default('acc0');

            $table->foreign('pembuat_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('penerima_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ttd_purchasing_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('detail_barang_id')->references('id')->on('detail_barang')->onDelete('cascade');
            $table->foreign('pembelian_id')->references('id')->on('pembelian')->onDelete('cascade');
            $table->foreign('pengecekan_id')->references('id')->on('pengecekan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita_acara', function (Blueprint $table) {
            //
        });
    }
};
