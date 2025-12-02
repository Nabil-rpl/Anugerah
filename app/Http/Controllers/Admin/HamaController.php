<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hama;
use App\Models\SubLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hama = Hama::with('sublayanan')
            ->orderBy('id_hama', 'desc')
            ->get();
        
        $sublayanan = SubLayanan::orderBy('nama_sublayanan', 'asc')->get();
        
        return view('admin.hama.index', compact('hama', 'sublayanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sublayanan = SubLayanan::orderBy('nama_sublayanan', 'asc')->get();
        return view('admin.hama.create', compact('sublayanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_hama' => 'required|string|max:50',
            'id_sublayanan' => 'nullable|exists:app_mstsublayanan,id_sublayanan',
        ], [
            'nama_hama.required' => 'Nama hama harus diisi',
            'nama_hama.max' => 'Nama hama maksimal 50 karakter',
            'id_sublayanan.exists' => 'Sub layanan tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal menambah hama. Periksa kembali input Anda.');
        }

        try {
            Hama::create([
                'nama_hama' => $request->nama_hama,
                'id_sublayanan' => $request->id_sublayanan ?: null,
            ]);

            return redirect()->route('admin.hama.index')
                ->with('success', 'Hama berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambah hama: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hama = Hama::with('sublayanan')->findOrFail($id);
        return view('admin.hama.show', compact('hama'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hama = Hama::findOrFail($id);
        $sublayanan = SubLayanan::orderBy('nama_sublayanan', 'asc')->get();
        return view('admin.hama.edit', compact('hama', 'sublayanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $hama = Hama::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_hama' => 'required|string|max:50',
            'id_sublayanan' => 'nullable|exists:app_mstsublayanan,id_sublayanan',
        ], [
            'nama_hama.required' => 'Nama hama harus diisi',
            'nama_hama.max' => 'Nama hama maksimal 50 karakter',
            'id_sublayanan.exists' => 'Sub layanan tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Gagal mengupdate hama. Periksa kembali input Anda.');
        }

        try {
            $hama->update([
                'nama_hama' => $request->nama_hama,
                'id_sublayanan' => $request->id_sublayanan ?: null,
            ]);

            return redirect()->route('admin.hama.index')
                ->with('success', 'Hama berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate hama: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $hama = Hama::findOrFail($id);
            $hama->delete();

            return redirect()->route('admin.hama.index')
                ->with('success', 'Hama berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus hama: ' . $e->getMessage());
        }
    }
}