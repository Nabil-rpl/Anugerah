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
        Schema::table('kota', function (Blueprint $table) {
            $table->foreign(['kode_provinsi'], 'regencies_province_id_foreign')->references(['kode_provinsi'])->on('provinsi')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kota', function (Blueprint $table) {
            $table->dropForeign('regencies_province_id_foreign');
        });
    }
};
