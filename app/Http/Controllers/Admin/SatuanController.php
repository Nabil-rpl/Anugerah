<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $satuan = Satuan::orderBy('kodesatuan', 'asc')->get();
        
        return view('admin.satuan.index', compact('satuan'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $satuan = Satuan::findOrFail($id);
            
            return view('admin.satuan.show', compact('satuan'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.satuan.index')
                ->with('error', 'Data satuan tidak ditemukan');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namasatuan' => 'required|string|max:50',
        ], [
            'namasatuan.required' => 'Nama satuan wajib diisi',
            'namasatuan.max' => 'Nama satuan maksimal 50 karakter',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Satuan::create([
                'namasatuan' => $request->namasatuan,
            ]);

            return redirect()->route('admin.satuan.index')
                ->with('success', 'Data satuan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data satuan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'namasatuan' => 'required|string|max:50',
        ], [
            'namasatuan.required' => 'Nama satuan wajib diisi',
            'namasatuan.max' => 'Nama satuan maksimal 50 karakter',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $satuan = Satuan::findOrFail($id);
            
            $satuan->update([
                'namasatuan' => $request->namasatuan,
            ]);

            return redirect()->route('admin.satuan.index')
                ->with('success', 'Data satuan berhasil diperbarui');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()
                ->with('error', 'Data satuan tidak ditemukan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data satuan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $satuan = Satuan::findOrFail($id);
            $satuan->delete();

            return redirect()->route('admin.satuan.index')
                ->with('success', 'Data satuan berhasil dihapus');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()
                ->with('error', 'Data satuan tidak ditemukan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data satuan: ' . $e->getMessage());
        }
    }
}