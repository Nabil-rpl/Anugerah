<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Kota;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kecamatan::with('kota.provinsi');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_kecamatan', 'like', "%{$search}%")
                  ->orWhere('kode_kecamatan', 'like', "%{$search}%");
            });
        }

        // Filter by kota
        if ($request->has('kota') && $request->kota != '') {
            $query->where('kode_kota', $request->kota);
        }

        $kecamatans = $query->orderBy('nama_kecamatan', 'asc')->paginate(15);
        $kotas = Kota::with('provinsi')->orderBy('nama_kota', 'asc')->get();

        return view('admin.kecamatan.index', compact('kecamatans', 'kotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kotas = Kota::with('provinsi')->orderBy('nama_kota', 'asc')->get();
        
        return view('admin.kecamatan.create', compact('kotas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kecamatan' => [
                'required',
                'string',
                'size:7',
                'unique:kecamatan,kode_kecamatan'
            ],
            'kode_kota' => [
                'required',
                'string',
                'size:4',
                'exists:kota,kode_kota'
            ],
            'nama_kecamatan' => [
                'required',
                'string',
                'max:255'
            ],
        ], [
            'kode_kecamatan.required' => 'Kode kecamatan wajib diisi',
            'kode_kecamatan.size' => 'Kode kecamatan harus 7 karakter',
            'kode_kecamatan.unique' => 'Kode kecamatan sudah digunakan',
            'kode_kota.required' => 'Kota wajib dipilih',
            'kode_kota.size' => 'Kode kota harus 4 karakter',
            'kode_kota.exists' => 'Kota tidak ditemukan di database',
            'nama_kecamatan.required' => 'Nama kecamatan wajib diisi',
            'nama_kecamatan.max' => 'Nama kecamatan maksimal 255 karakter',
        ]);

        try {
            Kecamatan::create([
                'kode_kecamatan' => $validated['kode_kecamatan'],
                'kode_kota' => $validated['kode_kota'],
                'nama_kecamatan' => $validated['nama_kecamatan'],
            ]);

            return redirect()
                ->route('admin.kecamatan.index')
                ->with('success', 'Data kecamatan berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan data kecamatan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode_kecamatan)
    {
        $kecamatan = Kecamatan::with('kota.provinsi')->findOrFail($kode_kecamatan);
        
        return view('admin.kecamatan.show', compact('kecamatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kode_kecamatan)
    {
        $kecamatan = Kecamatan::with('kota')->findOrFail($kode_kecamatan);
        $kotas = Kota::with('provinsi')->orderBy('nama_kota', 'asc')->get();
        
        return view('admin.kecamatan.edit', compact('kecamatan', 'kotas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $kode_kecamatan)
    {
        $kecamatan = Kecamatan::findOrFail($kode_kecamatan);

        $validated = $request->validate([
            'kode_kota' => [
                'required',
                'string',
                'size:4',
                'exists:kota,kode_kota'
            ],
            'nama_kecamatan' => [
                'required',
                'string',
                'max:255'
            ],
        ], [
            'kode_kota.required' => 'Kota wajib dipilih',
            'kode_kota.size' => 'Kode kota harus 4 karakter',
            'kode_kota.exists' => 'Kota tidak ditemukan di database',
            'nama_kecamatan.required' => 'Nama kecamatan wajib diisi',
            'nama_kecamatan.max' => 'Nama kecamatan maksimal 255 karakter',
        ]);

        try {
            $kecamatan->update([
                'kode_kota' => $validated['kode_kota'],
                'nama_kecamatan' => $validated['nama_kecamatan'],
            ]);

            return redirect()
                ->route('admin.kecamatan.index')
                ->with('success', 'Data kecamatan berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data kecamatan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kode_kecamatan)
    {
        try {
            $kecamatan = Kecamatan::findOrFail($kode_kecamatan);
            $kecamatan->delete();

            return redirect()
                ->route('admin.kecamatan.index')
                ->with('success', 'Data kecamatan berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus data kecamatan: ' . $e->getMessage());
        }
    }
}