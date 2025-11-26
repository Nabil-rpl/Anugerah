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
        Schema::table('kelurahan', function (Blueprint $table) {
            $table->foreign(['kode_kecamatan'], 'villages_district_id_foreign')->references(['kode_kecamatan'])->on('kecamatan')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelurahan', function (Blueprint $table) {
            $table->dropForeign('villages_district_id_foreign');
        });
    }
};
