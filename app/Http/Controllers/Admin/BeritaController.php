<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of berita.
     */
    public function index()
    {
        $berita = Berita::orderBy('tanggal', 'desc')->paginate(10);
        return view('admin.berita.index', compact('berita'));
    }

    /**
     * Show the form for creating a new berita.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Store a newly created berita.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sumber' => 'nullable|string|max:100',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/berita'), $filename);
            $data['gambar'] = $filename;
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified berita.
     */
    public function show($id)
    {
        /** @var Berita $berita */
        $berita = Berita::findOrFail($id);
        return view('admin.berita.show', compact('berita'));
    }

    /**
     * Show the form for editing berita.
     */
    public function edit($id)
    {
        /** @var Berita $berita */
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Update the specified berita.
     */
    public function update(Request $request, $id)
    {
        /** @var Berita $berita */
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sumber' => 'nullable|string|max:100',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar))) {
                unlink(public_path('uploads/berita/' . $berita->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/berita'), $filename);
            $data['gambar'] = $filename;
        } else {
            $data['gambar'] = $berita->gambar;
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diupdate!');
    }

    /**
     * Remove the specified berita.
     */
    public function destroy($id)
    {
        /** @var Berita $berita */
        $berita = Berita::findOrFail($id);

        // Delete image file
        if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar))) {
            unlink(public_path('uploads/berita/' . $berita->gambar));
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
}