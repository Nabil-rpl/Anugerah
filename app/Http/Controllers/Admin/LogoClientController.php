<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogoClient;
use Illuminate\Http\Request;

class LogoClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logos = LogoClient::orderBy('id', 'desc')->get();
        return view('admin.logo-client.index', compact('logos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.logo-client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|max:50',
            'gambar_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->only(['nama_perusahaan']);

        if ($request->hasFile('gambar_logo')) {
            $file = $request->file('gambar_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/logo-client'), $filename);
            $data['gambar_logo'] = $filename;
        }

        LogoClient::create($data);

        return redirect()->route('admin.logo-client.index')->with('success', 'Logo client berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(LogoClient $logoClient)
    {
        return view('admin.logo-client.show', compact('logoClient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogoClient $logoClient)
    {
        return view('admin.logo-client.edit', compact('logoClient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LogoClient $logoClient)
    {
        $request->validate([
            'nama_perusahaan' => 'required|max:50',
            'gambar_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->only(['nama_perusahaan']);

        if ($request->hasFile('gambar_logo')) {
            // Hapus gambar lama
            if ($logoClient->gambar_logo && file_exists(public_path('uploads/logo-client/' . $logoClient->gambar_logo))) {
                unlink(public_path('uploads/logo-client/' . $logoClient->gambar_logo));
            }

            $file = $request->file('gambar_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/logo-client'), $filename);
            $data['gambar_logo'] = $filename;
        }

        $logoClient->update($data);

        return redirect()->route('admin.logo-client.index')->with('success', 'Logo client berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogoClient $logoClient)
    {
        // Hapus gambar
        if ($logoClient->gambar_logo && file_exists(public_path('uploads/logo-client/' . $logoClient->gambar_logo))) {
            unlink(public_path('uploads/logo-client/' . $logoClient->gambar_logo));
        }

        $logoClient->delete();

        return redirect()->route('admin.logo-client.index')->with('success', 'Logo client berhasil dihapus');
    }
}