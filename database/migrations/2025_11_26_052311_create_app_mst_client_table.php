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
        Schema::create('app_mst_client', function (Blueprint $table) {
            $table->char('nomor_pelanggan', 10)->primary();
            $table->string('nama_pelanggan', 50)->nullable();
            $table->tinyText('alamat')->nullable();
            $table->char('kode_provinsi', 2)->nullable();
            $table->char('kode_kota', 4)->nullable();
            $table->char('kode_kecamatan', 7)->nullable();
            $table->char('kode_kelurahan', 10)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('nomor_telepon', 20)->nullable();
            $table->string('kontak', 50)->nullable();
            $table->integer('nomor_kontak')->nullable();
            $table->tinyText('catatan')->nullable();
            $table->timestamp('waktu')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_mst_client');
    }
};
