<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('app_msthama', function (Blueprint $table) {
            $table->integer('id_hama', true);
            $table->string('nama_hama', 50);
            $table->tinyInteger('id_sublayanan')->nullable(); // Ubah ke tinyInteger
            
            // Tambah index
            $table->index('id_sublayanan');
            
            // Tambah foreign key
            $table->foreign('id_sublayanan')
                  ->references('id_sublayanan')
                  ->on('app_mstsublayanan')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_msthama');
    }
};