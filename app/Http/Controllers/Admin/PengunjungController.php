<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengunjung;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    /**
     * Display a listing of pengunjung.
     */
    public function index()
    {
        $pengunjung = Pengunjung::orderBy('waktu', 'desc')->paginate(10);
        return view('admin.pengunjung.index', compact('pengunjung'));
    }

    /**
     * Show the form for creating a new pengunjung.
     */
    public function create()
    {
        return view('admin.pengunjung.create');
    }

    /**
     * Store a newly created pengunjung.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'alamat_lengkap' => 'nullable|string',
            'kode_provinsi' => 'nullable|string|size:2',
            'kode_kota' => 'nullable|string|size:4',
            'kode_kecamatan' => 'nullable|string|size:7',
            'kode_kelurahan' => 'nullable|string|size:10',
            'email' => 'nullable|email|max:50',
            'nomor_telepon' => 'nullable|string|max:20',
            'pesan' => 'nullable|string',
            'lokasi_pengisi' => 'nullable|string|max:50',
            'status' => 'nullable|boolean',
        ]);

        Pengunjung::create($request->all());

        return redirect()->route('admin.pengunjung.index')
            ->with('success', 'Data pengunjung berhasil ditambahkan!');
    }

    /**
     * Display the specified pengunjung.
     */
    public function show($id)
    {
        /** @var Pengunjung $pengunjung */
        $pengunjung = Pengunjung::findOrFail($id);
        return view('admin.pengunjung.show', compact('pengunjung'));
    }

    /**
     * Show the form for editing pengunjung.
     */
    public function edit($id)
    {
        /** @var Pengunjung $pengunjung */
        $pengunjung = Pengunjung::findOrFail($id);
        return view('admin.pengunjung.edit', compact('pengunjung'));
    }

    /**
     * Update the specified pengunjung.
     */
    public function update(Request $request, $id)
    {
        /** @var Pengunjung $pengunjung */
        $pengunjung = Pengunjung::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'alamat_lengkap' => 'nullable|string',
            'kode_provinsi' => 'nullable|string|size:2',
            'kode_kota' => 'nullable|string|size:4',
            'kode_kecamatan' => 'nullable|string|size:7',
            'kode_kelurahan' => 'nullable|string|size:10',
            'email' => 'nullable|email|max:50',
            'nomor_telepon' => 'nullable|string|max:20',
            'pesan' => 'nullable|string',
            'lokasi_pengisi' => 'nullable|string|max:50',
            'status' => 'nullable|boolean',
        ]);

        $pengunjung->update($request->all());

        return redirect()->route('admin.pengunjung.index')
            ->with('success', 'Data pengunjung berhasil diupdate!');
    }

    /**
     * Remove the specified pengunjung.
     */
    public function destroy($id)
    {
        /** @var Pengunjung $pengunjung */
        $pengunjung = Pengunjung::findOrFail($id);
        $pengunjung->delete();

        return redirect()->route('admin.pengunjung.index')
            ->with('success', 'Data pengunjung berhasil dihapus!');
    }

    /**
     * Toggle status pengunjung.
     */
    public function toggleStatus($id)
    {
        /** @var Pengunjung $pengunjung */
        $pengunjung = Pengunjung::findOrFail($id);
        $pengunjung->status = !$pengunjung->status;
        $pengunjung->save();

        return redirect()->route('admin.pengunjung.index')
            ->with('success', 'Status berhasil diubah!');
    }
}