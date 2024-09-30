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
        Schema::create('pembelian', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('company_id');
            $table->string('pp');
            $table->date('pp_date');
            $table->string('po');
            $table->date('po_date');
            $table->string('sj');
            $table->date('sj_date');
            $table->date('receipt_date');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('pt_tujuans')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
};
