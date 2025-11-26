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
        Schema::create('app_perstreatperlengkapan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_perstreatment')->nullable();
            $table->integer('id_peralatan')->nullable();
            $table->integer('jumlah')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_perstreatperlengkapan');
    }
};
