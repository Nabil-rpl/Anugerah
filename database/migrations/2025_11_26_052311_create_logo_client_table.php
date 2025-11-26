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
        Schema::create('logo_client', function (Blueprint $table) {
            $table->tinyInteger('id', true);
            $table->string('nama_perusahaan', 50)->nullable();
            $table->string('gambar_logo', 50)->nullable();
            $table->timestamp('waktu')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logo_client');
    }
};
