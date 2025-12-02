<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of provinsi.
     */
    public function index()
    {
        $provinsi = Provinsi::orderBy('kode_provinsi', 'asc')->paginate(15);
        return view('admin.provinsi.index', compact('provinsi'));
    }

    /**
     * Store a newly created provinsi.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_provinsi' => 'required|string|size:2|unique:provinsi,kode_provinsi',
            'nama_provinsi' => 'required|string|max:255',
        ]);

        Provinsi::create([
            'kode_provinsi' => strtoupper($request->kode_provinsi),
            'nama_provinsi' => $request->nama_provinsi,
        ]);

        return redirect()->route('admin.provinsi.index')
            ->with('success', 'Provinsi berhasil ditambahkan!');
    }

    /**
     * Update the specified provinsi.
     */
    public function update(Request $request, $kode)
    {
        /** @var Provinsi $provinsi */
        $provinsi = Provinsi::findOrFail($kode);

        $request->validate([
            'nama_provinsi' => 'required|string|max:255',
        ]);

        $provinsi->update([
            'nama_provinsi' => $request->nama_provinsi,
        ]);

        return redirect()->route('admin.provinsi.index')
            ->with('success', 'Provinsi berhasil diupdate!');
    }

    /**
     * Remove the specified provinsi.
     */
    public function destroy($kode)
    {
        /** @var Provinsi $provinsi */
        $provinsi = Provinsi::findOrFail($kode);
        $provinsi->delete();

        return redirect()->route('admin.provinsi.index')
            ->with('success', 'Provinsi berhasil dihapus!');
    }
}