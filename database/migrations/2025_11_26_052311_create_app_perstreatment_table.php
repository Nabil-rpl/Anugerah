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
        Schema::create('app_perstreatment', function (Blueprint $table) {
            $table->integer('id_treatment', true);
            $table->char('nomor_pelanggan', 10)->nullable();
            $table->dateTime('waktu_treatment')->nullable();
            $table->timestamp('waktu_update')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_perstreatment');
    }
};
