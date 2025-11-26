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
        Schema::create('app_mstalat', function (Blueprint $table) {
            $table->integer('idalat', true);
            $table->string('namaalat', 100)->nullable();
            $table->tinyInteger('kodesatuan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->tinyInteger('kodekategorialat')->nullable();
            $table->tinyText('keterangan')->nullable();
            $table->timestamp('waktu')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_mstalat');
    }
};
