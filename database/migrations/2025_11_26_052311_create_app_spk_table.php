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
        Schema::create('app_spk', function (Blueprint $table) {
            $table->string('nospk', 50)->primary();
            $table->char('nomorpelanggan', 10)->nullable();
            $table->string('nomornpwp', 50)->nullable();
            $table->date('awalkontrak')->nullable();
            $table->date('akhirkontrak')->nullable();
            $table->string('hamasasaran', 50)->nullable();
            $table->string('treatmen', 50)->nullable();
            $table->string('metodetreatmen', 50)->nullable();
            $table->string('aplikasitreatmen', 50)->nullable();
            $table->decimal('hargarumah', 11, 0)->nullable();
            $table->decimal('hargakantor', 11, 0)->nullable();
            $table->decimal('transportasi', 11, 0)->nullable();
            $table->tinyText('keterangan')->nullable();
            $table->timestamp('waktu')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_spk');
    }
};
