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
        Schema::create('app_mstkaryawan', function (Blueprint $table) {
            $table->string('nip', 20)->primary();
            $table->string('nama_karyawan', 100);
            $table->tinyText('alamat')->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('notelepon', 20)->nullable();
            $table->string('nik', 20)->nullable();
            $table->string('foto', 100)->nullable();
            $table->tinyText('keterangan')->nullable();
            $table->char('katakunci', 100)->nullable();
            $table->string('alamat_email', 100)->nullable();
            $table->char('kodedepartemen', 2)->nullable();
            $table->timestamp('waktu')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_mstkaryawan');
    }
};
