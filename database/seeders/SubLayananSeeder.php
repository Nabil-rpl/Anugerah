<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubLayananSeeder extends Seeder
{
    public function run()
    {
        DB::table('app_mstsublayanan')->insert([
            ['nama_sublayanan' => 'Fumigasi', 'id_layanan' => 1],
            ['nama_sublayanan' => 'Fogging', 'id_layanan' => 1],
            ['nama_sublayanan' => 'Sanitasi', 'id_layanan' => 2],
            ['nama_sublayanan' => 'Disinfeksi', 'id_layanan' => 2],
            ['nama_sublayanan' => 'Pest Control', 'id_layanan' => 1],
            ['nama_sublayanan' => 'Rat Control', 'id_layanan' => 1],
            ['nama_sublayanan' => 'Cockroach Control', 'id_layanan' => 1],
            ['nama_sublayanan' => 'Termite Control', 'id_layanan' => 1],
        ]);
    }
}