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
        Schema::create('detail_barang', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('brand_id');
            $table->string('type_id');
            $table->string('serial_number');
            $table->string('pc_name');
            $table->string('password');
            $table->string('os_id');
            $table->string('os_product_key');
            $table->string('office_id');
            $table->string('office_product_key');
            $table->string('other')->nullable();
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brand')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('type')->onDelete('cascade');
            $table->foreign('os_id')->references('id')->on('os')->onDelete('cascade');
            $table->foreign('office_id')->references('id')->on('office')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_barang');
    }
};
