<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('waktu', 'desc')->paginate(10);
        return view('admin.client.index', compact('clients'));
    }

    public function create()
    {
        $nomorPelanggan = Client::generateNomorPelanggan();
        return view('admin.client.create', compact('nomorPelanggan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_pelanggan' => 'required|string|max:10|unique:app_mst_client,nomor_pelanggan',
            'nama_pelanggan' => 'required|string|max:50',
            'alamat' => 'nullable|string',
            'kode_provinsi' => 'nullable|string|max:2',
            'kode_kota' => 'nullable|string|max:4',
            'kode_kecamatan' => 'nullable|string|max:7',
            'kode_kelurahan' => 'nullable|string|max:10',
            'email' => 'nullable|email|max:50',
            'nomor_telepon' => 'nullable|string|max:20',
            'kontak' => 'nullable|string|max:50',
            'nomor_kontak' => 'nullable|integer|max:2147483647',
            'catatan' => 'nullable|string',
        ]);

        $validated['waktu'] = now();

        Client::create($validated);

        return redirect()->route('admin.client.index')
            ->with('success', 'Data client berhasil ditambahkan.');
    }

    public function show(Client $client)
    {
        return view('admin.client.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('admin.client.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:50',
            'alamat' => 'nullable|string',
            'kode_provinsi' => 'nullable|string|max:2',
            'kode_kota' => 'nullable|string|max:4',
            'kode_kecamatan' => 'nullable|string|max:7',
            'kode_kelurahan' => 'nullable|string|max:10',
            'email' => 'nullable|email|max:50',
            'nomor_telepon' => 'nullable|string|max:20',
            'kontak' => 'nullable|string|max:50',
            'nomor_kontak' => 'nullable|integer|max:2147483647',
            'catatan' => 'nullable|string',
        ]);

        $client->update($validated);

        return redirect()->route('admin.client.index')
            ->with('success', 'Data client berhasil diupdate.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('admin.client.index')
            ->with('success', 'Data client berhasil dihapus.');
    }
}