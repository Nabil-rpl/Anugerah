<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kota::with(['provinsi', 'kecamatans']);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_kota', 'like', "%{$search}%")
                  ->orWhere('kode_kota', 'like', "%{$search}%");
            });
        }

        $kotas = $query->orderBy('nama_kota', 'asc')->paginate(10);

        return view('admin.kota.index', compact('kotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinsis = Provinsi::orderBy('nama_provinsi', 'asc')->get();
        
        return view('admin.kota.create', compact('provinsis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kota' => [
                'required',
                'string',
                'size:4',
                'unique:kota,kode_kota'
            ],
            'kode_provinsi' => [
                'required',
                'string',
                'size:2',
                'exists:provinsi,kode_provinsi'
            ],
            'nama_kota' => [
                'required',
                'string',
                'max:255'
            ]
        ], [
            'kode_kota.required' => 'Kode kota wajib diisi',
            'kode_kota.size' => 'Kode kota harus 4 karakter',
            'kode_kota.unique' => 'Kode kota sudah digunakan',
            'kode_provinsi.required' => 'Provinsi wajib dipilih',
            'kode_provinsi.exists' => 'Provinsi tidak valid',
            'nama_kota.required' => 'Nama kota wajib diisi',
            'nama_kota.max' => 'Nama kota maksimal 255 karakter'
        ]);

        try {
            Kota::create([
                'kode_kota' => strtoupper($validated['kode_kota']),
                'kode_provinsi' => $validated['kode_provinsi'],
                'nama_kota' => $validated['nama_kota']
            ]);

            return redirect()
                ->route('admin.kota.index')
                ->with('success', 'Data kota berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan data kota: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode_kota)
    {
        $kota = Kota::with(['provinsi', 'kecamatans'])
            ->findOrFail($kode_kota);

        return view('admin.kota.show', compact('kota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kode_kota)
    {
        $kota = Kota::with('kecamatans')->findOrFail($kode_kota);
        $provinsis = Provinsi::orderBy('nama_provinsi', 'asc')->get();

        return view('admin.kota.edit', compact('kota', 'provinsis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $kode_kota)
    {
        $kota = Kota::findOrFail($kode_kota);

        $validated = $request->validate([
            'kode_provinsi' => [
                'required',
                'string',
                'size:2',
                'exists:provinsi,kode_provinsi'
            ],
            'nama_kota' => [
                'required',
                'string',
                'max:255'
            ]
        ], [
            'kode_provinsi.required' => 'Provinsi wajib dipilih',
            'kode_provinsi.exists' => 'Provinsi tidak valid',
            'nama_kota.required' => 'Nama kota wajib diisi',
            'nama_kota.max' => 'Nama kota maksimal 255 karakter'
        ]);

        try {
            $kota->update([
                'kode_provinsi' => $validated['kode_provinsi'],
                'nama_kota' => $validated['nama_kota']
            ]);

            return redirect()
                ->route('admin.kota.index')
                ->with('success', 'Data kota berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data kota: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kode_kota)
    {
        try {
            $kota = Kota::findOrFail($kode_kota);
            
            // Check if kota has related kecamatan
            $kecamatanCount = $kota->kecamatans()->count();
            
            if ($kecamatanCount > 0) {
                return redirect()
                    ->back()
                    ->with('error', "Tidak dapat menghapus kota. Masih terdapat {$kecamatanCount} kecamatan terkait.");
            }

            $kota->delete();

            return redirect()
                ->route('admin.kota.index')
                ->with('success', 'Data kota berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus data kota: ' . $e->getMessage());
        }
    }
}