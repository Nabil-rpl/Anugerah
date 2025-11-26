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
        Schema::create('app_perstreatpetugas', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_perstreatment')->nullable();
            $table->string('nip', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_perstreatpetugas');
    }
};
