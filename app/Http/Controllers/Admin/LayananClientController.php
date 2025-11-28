<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananClient;
use Illuminate\Http\Request;

class LayananClientController extends Controller
{
    public function index()
    {
        $layananClients = LayananClient::orderBy('tanggal', 'desc')->paginate(10);
        return view('admin.layanan-client.index', compact('layananClients'));
    }

    public function create()
    {
        return view('admin.layanan-client.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/layanan-client'), $filename);
            $validated['gambar'] = 'uploads/layanan-client/' . $filename;
        }

        $validated['tanggal'] = now();

        LayananClient::create($validated);

        return redirect()->route('admin.layanan-client.index')
            ->with('success', 'Layanan client berhasil ditambahkan.');
    }

    public function show(LayananClient $layananClient)
    {
        return view('admin.layanan-client.show', compact('layananClient'));
    }

    public function edit(LayananClient $layananClient)
    {
        return view('admin.layanan-client.edit', compact('layananClient'));
    }

    public function update(Request $request, LayananClient $layananClient)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($layananClient->gambar && file_exists(public_path($layananClient->gambar))) {
                unlink(public_path($layananClient->gambar));
            }
            
            // Upload gambar baru
            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/layanan-client'), $filename);
            $validated['gambar'] = 'uploads/layanan-client/' . $filename;
        }

        $layananClient->update($validated);

        return redirect()->route('admin.layanan-client.index')
            ->with('success', 'Layanan client berhasil diupdate.');
    }

    public function destroy(LayananClient $layananClient)
    {
        // Hapus gambar
        if ($layananClient->gambar && file_exists(public_path($layananClient->gambar))) {
            unlink(public_path($layananClient->gambar));
        }

        $layananClient->delete();

        return redirect()->route('admin.layanan-client.index')
            ->with('success', 'Layanan client berhasil dihapus.');
    }
}