<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;

class JenisLayananController extends Controller
{
    public function index()
    {
        $jenisLayanan = JenisLayanan::orderBy('id_jenislayanan', 'asc')->paginate(10);
        return view('admin.jenis-layanan.index', compact('jenisLayanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jenislayanan' => 'required|numeric|between:1,127|unique:app_mstjenislayanan,id_jenislayanan',
            'nama_layanan' => 'required|string|max:20',
        ]);

        JenisLayanan::create([
            'id_jenislayanan' => $request->id_jenislayanan,
            'nama_layanan' => $request->nama_layanan,
        ]);

        return redirect()->route('admin.jenis-layanan.index')
            ->with('success', 'Jenis layanan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $jenisLayanan = JenisLayanan::findOrFail($id);

        $request->validate([
            'nama_layanan' => 'required|string|max:20',
        ]);

        $jenisLayanan->update([
            'nama_layanan' => $request->nama_layanan,
        ]);

        return redirect()->route('admin.jenis-layanan.index')
            ->with('success', 'Jenis layanan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $jenisLayanan = JenisLayanan::findOrFail($id);
        $jenisLayanan->delete();

        return redirect()->route('admin.jenis-layanan.index')
            ->with('success', 'Jenis layanan berhasil dihapus!');
    }
}