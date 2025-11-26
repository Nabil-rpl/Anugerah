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
        Schema::create('kelurahan', function (Blueprint $table) {
            $table->char('kode_kelurahan', 10)->primary();
            $table->char('kode_kecamatan', 7)->index('villages_district_id_index');
            $table->string('nama_kelurahan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelurahan');
    }
};
