<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriAlat;
use Illuminate\Http\Request;

class KategoriAlatController extends Controller
{
    public function index()
    {
        $kategoris = KategoriAlat::all();
        return view('admin.kategori-alat.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori-alat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namakategori' => 'required|max:50',
            'keterangan' => 'nullable'
        ]);

        KategoriAlat::create($request->only(['namakategori', 'keterangan']));

        return redirect()->route('admin.kategori-alat.index')
            ->with('success', 'Kategori Alat berhasil ditambahkan');
    }

    public function show($kodekategori)
    {
        $kategoriAlat = KategoriAlat::findOrFail($kodekategori);
        return view('admin.kategori-alat.show', compact('kategoriAlat'));
    }

    public function edit($kodekategori)
    {
        $kategoriAlat = KategoriAlat::findOrFail($kodekategori);
        return view('admin.kategori-alat.edit', compact('kategoriAlat'));
    }

    public function update(Request $request, $kodekategori)
    {
        $request->validate([
            'namakategori' => 'required|max:50',
            'keterangan' => 'nullable'
        ]);

        $kategoriAlat = KategoriAlat::findOrFail($kodekategori);
        $kategoriAlat->update($request->only(['namakategori', 'keterangan']));

        return redirect()->route('admin.kategori-alat.index')
            ->with('success', 'Kategori Alat berhasil diupdate');
    }

    public function destroy($kodekategori)
    {
        $kategoriAlat = KategoriAlat::findOrFail($kodekategori);
        $kategoriAlat->delete();

        return redirect()->route('admin.kategori-alat.index')
            ->with('success', 'Kategori Alat berhasil dihapus');
    }
}