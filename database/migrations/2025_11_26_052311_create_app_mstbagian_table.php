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
        Schema::create('app_mstbagian', function (Blueprint $table) {
            $table->char('kodedepartemen', 2)->primary();
            $table->string('namadepartemen', 20);
            $table->tinyText('keterangan')->nullable();
            $table->timestamp('waktu', 1)->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_mstbagian');
    }
};
