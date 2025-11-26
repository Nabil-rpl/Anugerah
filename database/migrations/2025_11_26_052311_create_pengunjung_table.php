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
        Schema::create('pengunjung', function (Blueprint $table) {
            $table->integer('id_pengunjung', true);
            $table->string('nama_lengkap', 100)->nullable();
            $table->tinyText('alamat_lengkap')->nullable();
            $table->char('kode_provinsi', 2)->nullable();
            $table->char('kode_kota', 4)->nullable();
            $table->char('kode_kecamatan', 7)->nullable();
            $table->char('kode_kelurahan', 10)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('nomor_telepon', 20)->nullable();
            $table->tinyText('pesan')->nullable();
            $table->timestamp('waktu')->useCurrentOnUpdate()->useCurrent();
            $table->string('lokasi_pengisi', 50)->nullable();
            $table->boolean('status')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengunjung');
    }
};
