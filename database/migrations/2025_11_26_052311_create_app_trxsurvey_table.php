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
        Schema::create('app_trxsurvey', function (Blueprint $table) {
            $table->integer('id_surver', true);
            $table->date('tanggal')->nullable();
            $table->char('nomor_pelanggan', 10);
            $table->tinyInteger('id_segmen')->nullable();
            $table->tinyInteger('id_layanan')->nullable();
            $table->tinyInteger('id_sublayanan')->nullable();
            $table->enum('perlakukan', ['Reguler', 'Iso'])->nullable();
            $table->decimal('jumlah', 10, 0)->nullable();
            $table->tinyText('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_trxsurvey');
    }
};
