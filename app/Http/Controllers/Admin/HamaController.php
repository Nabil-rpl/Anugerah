<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hama;
use App\Models\SubLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HamaController extends Controller
{
    public function index()
    {
        $hama = Hama::with('sublayanan')
            ->orderBy('id_hama', 'desc')
            ->get();
        
        // Sudah benar karena menggunakan Model
        $sublayanan = SubLayanan::orderBy('nama_sublayanan', 'asc')->get();
        
        return view('admin.hama.index', compact('hama', 'sublayanan'));
    }
    
    // Method lainnya tetap sama
}