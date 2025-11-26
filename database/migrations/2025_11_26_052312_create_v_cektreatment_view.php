<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus view jika sudah ada (mencegah error 1050)
        DB::statement("DROP VIEW IF EXISTS `v_cektreatment`");

        // Buat view lagi
        DB::statement("
            CREATE VIEW `v_cektreatment` AS
            SELECT 
                p.id AS id,
                p.id_lokasi AS id_lokasi,
                p.id_peralatan AS id_peralatan,
                p.id_perstreatment AS id_perstreatment,
                c.nama_pelanggan AS nama_pelanggan,
                t.nomor_pelanggan AS nomor_pelanggan,
                l.nama_lokasi AS nama_lokasi,
                alat.idalat AS idalat,
                alat.namaalat AS namaalat
            FROM anugerah.app_perstreatperalatan p
            JOIN anugerah.app_perstreatment t ON p.id_perstreatment = t.id_treatment
            JOIN anugerah.app_mst_client c ON c.nomor_pelanggan = t.nomor_pelanggan
            JOIN anugerah.app_perstreatlokasi l ON l.id = p.id_lokasi
            JOIN anugerah.app_mstalat alat ON alat.idalat = p.id_peralatan
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_cektreatment`");
    }
};
