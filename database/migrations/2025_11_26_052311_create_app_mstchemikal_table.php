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
        Schema::create('app_mstchemikal', function (Blueprint $table) {
            $table->integer('idchemikal', true);
            $table->string('namachemikal', 100)->nullable();
            $table->string('satuan', 50)->nullable();
            $table->integer('jumlah')->nullable();
            $table->tinyText('keterangan')->nullable();
            $table->timestamp('waktu')->useCurrentOnUpdate()->useCurrent();
            $table->enum('jenis', ['Chemikal', 'Non-Chemikal'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_mstchemikal');
    }
};
