<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubLayanan;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sublayanan = SubLayanan::with('jenisLayanan')
            ->orderBy('id_sublayanan', 'asc')
            ->get();
        
        $jenisLayanan = JenisLayanan::orderBy('nama_layanan', 'asc')->get();
        
        return view('admin.sublayanan.index', compact('sublayanan', 'jenisLayanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sublayanan' => 'required|string|max:30',
            'id_layanan' => 'nullable|exists:app_mstjenislayanan,id_jenislayanan',
        ], [
            'nama_sublayanan.required' => 'Nama sub layanan harus diisi',
            'nama_sublayanan.max' => 'Nama sub layanan maksimal 30 karakter',
            'id_layanan.exists' => 'Jenis layanan tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal menambah sub layanan. Periksa kembali input Anda.');
        }

        try {
            SubLayanan::create([
                'nama_sublayanan' => $request->nama_sublayanan,
                'id_layanan' => $request->id_layanan,
            ]);

            return redirect()->route('admin.sublayanan.index')
                ->with('success', 'Sub layanan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambah sub layanan: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sublayanan = SubLayanan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_sublayanan' => 'required|string|max:30',
            'id_layanan' => 'nullable|exists:app_mstjenislayanan,id_jenislayanan',
        ], [
            'nama_sublayanan.required' => 'Nama sub layanan harus diisi',
            'nama_sublayanan.max' => 'Nama sub layanan maksimal 30 karakter',
            'id_layanan.exists' => 'Jenis layanan tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Gagal mengupdate sub layanan. Periksa kembali input Anda.');
        }

        try {
            $sublayanan->update([
                'nama_sublayanan' => $request->nama_sublayanan,
                'id_layanan' => $request->id_layanan,
            ]);

            return redirect()->route('admin.sublayanan.index')
                ->with('success', 'Sub layanan berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate sub layanan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $sublayanan = SubLayanan::findOrFail($id);
            
            // Cek apakah ada hama yang menggunakan sub layanan ini
            if ($sublayanan->hama()->count() > 0) {
                return redirect()->back()
                    ->with('error', 'Sub layanan tidak dapat dihapus karena masih digunakan oleh ' . $sublayanan->hama()->count() . ' hama!');
            }
            
            $sublayanan->delete();

            return redirect()->route('admin.sublayanan.index')
                ->with('success', 'Sub layanan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus sub layanan: ' . $e->getMessage());
        }
    }
}