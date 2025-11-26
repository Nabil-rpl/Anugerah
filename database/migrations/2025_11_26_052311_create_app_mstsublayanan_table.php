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
        Schema::create('app_mstsublayanan', function (Blueprint $table) {
            $table->tinyInteger('id_sublayanan', true);
            $table->tinyInteger('id_layanan')->nullable();
            $table->string('nama_sublayanan', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_mstsublayanan');
    }
};
