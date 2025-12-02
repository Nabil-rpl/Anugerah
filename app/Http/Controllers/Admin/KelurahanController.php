<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelurahan = Kelurahan::with('kecamatan')
            ->orderBy('kode_kelurahan', 'asc')
            ->get();
        
        // Get kecamatan untuk dropdown
        $kecamatan = DB::table('kecamatan')
            ->orderBy('nama_kecamatan', 'asc')
            ->get();
        
        return view('admin.kelurahan.index', compact('kelurahan', 'kecamatan'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $kelurahan = Kelurahan::with('kecamatan')->findOrFail($id);
            
            return view('admin.kelurahan.show', compact('kelurahan'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.kelurahan.index')
                ->with('error', 'Data kelurahan tidak ditemukan');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_kelurahan' => 'required|string|max:10|unique:kelurahan,kode_kelurahan',
            'kode_kecamatan' => 'required|string|max:7|exists:kecamatan,kode_kecamatan',
            'nama_kelurahan' => 'required|string|max:255',
        ], [
            'kode_kelurahan.required' => 'Kode kelurahan wajib diisi',
            'kode_kelurahan.unique' => 'Kode kelurahan sudah digunakan',
            'kode_kecamatan.required' => 'Kecamatan wajib dipilih',
            'kode_kecamatan.exists' => 'Kecamatan tidak valid',
            'nama_kelurahan.required' => 'Nama kelurahan wajib diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Kelurahan::create([
                'kode_kelurahan' => $request->kode_kelurahan,
                'kode_kecamatan' => $request->kode_kecamatan,
                'nama_kelurahan' => $request->nama_kelurahan,
            ]);

            return redirect()->route('admin.kelurahan.index')
                ->with('success', 'Data kelurahan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data kelurahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_kecamatan' => 'required|string|max:7|exists:kecamatan,kode_kecamatan',
            'nama_kelurahan' => 'required|string|max:255',
        ], [
            'kode_kecamatan.required' => 'Kecamatan wajib dipilih',
            'kode_kecamatan.exists' => 'Kecamatan tidak valid',
            'nama_kelurahan.required' => 'Nama kelurahan wajib diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $kelurahan = Kelurahan::findOrFail($id);
            
            $kelurahan->update([
                'kode_kecamatan' => $request->kode_kecamatan,
                'nama_kelurahan' => $request->nama_kelurahan,
            ]);

            return redirect()->route('admin.kelurahan.index')
                ->with('success', 'Data kelurahan berhasil diperbarui');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()
                ->with('error', 'Data kelurahan tidak ditemukan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data kelurahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $kelurahan = Kelurahan::findOrFail($id);
            $kelurahan->delete();

            return redirect()->route('admin.kelurahan.index')
                ->with('success', 'Data kelurahan berhasil dihapus');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()
                ->with('error', 'Data kelurahan tidak ditemukan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data kelurahan: ' . $e->getMessage());
        }
    }
}