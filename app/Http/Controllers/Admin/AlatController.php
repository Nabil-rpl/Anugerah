<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\KategoriAlat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with('kategori')->get();
        return view('admin.alat.index', compact('alats'));
    }

    public function create()
    {
        $kategoris = KategoriAlat::all();
        return view('admin.alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaalat' => 'required|max:100',
            'kodesatuan' => 'nullable|integer',
            'jumlah' => 'nullable|integer',
            'kodekategorialat' => 'nullable|integer',
            'keterangan' => 'nullable'
        ]);

        Alat::create($request->only([
            'namaalat',
            'kodesatuan',
            'jumlah',
            'kodekategorialat',
            'keterangan'
        ]));

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }

    public function show($idalat)
    {
        $alat = Alat::with('kategori')->findOrFail($idalat);
        return view('admin.alat.show', compact('alat'));
    }

    public function edit($idalat)
    {
        $alat = Alat::findOrFail($idalat);
        $kategoris = KategoriAlat::all();
        return view('admin.alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, $idalat)
    {
        $request->validate([
            'namaalat' => 'required|max:100',
            'kodesatuan' => 'nullable|integer',
            'jumlah' => 'nullable|integer',
            'kodekategorialat' => 'nullable|integer',
            'keterangan' => 'nullable'
        ]);

        $alat = Alat::findOrFail($idalat);
        $alat->update($request->only([
            'namaalat',
            'kodesatuan',
            'jumlah',
            'kodekategorialat',
            'keterangan'
        ]));

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil diupdate');
    }

    public function destroy($idalat)
    {
        $alat = Alat::findOrFail($idalat);
        $alat->delete();

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil dihapus');
    }
}