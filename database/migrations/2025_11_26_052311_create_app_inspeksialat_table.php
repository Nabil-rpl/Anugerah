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
        Schema::create('app_inspeksialat', function (Blueprint $table) {
            $table->integer('id_treatment', true);
            $table->integer('id_peralatan')->nullable();
            $table->string('nama_hama', 100)->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('kondisi_lampu', 45)->nullable();
            $table->string('kondisi_lem', 45)->nullable();
            $table->string('kondisi_rodent_bait', 45)->nullable();
            $table->string('kondisi_umpan_bait', 45)->nullable();
            $table->integer('jumlah_refil')->nullable();
            $table->timestamp('waktu')->nullable()->useCurrent();
            $table->string('foto', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_inspeksialat');
    }
};
