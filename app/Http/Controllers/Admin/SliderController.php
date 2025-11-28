<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:100',
            'isi' => 'nullable',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['judul', 'isi']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/slider'), $filename);
            $data['gambar'] = $filename;
        }

        Slider::create($data);

        return redirect()->route('admin.slider.index')->with('success', 'Slider berhasil ditambahkan');
    }

    public function show(Slider $slider)
    {
        return view('admin.slider.show', compact('slider'));
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'judul' => 'required|max:100',
            'isi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['judul', 'isi']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($slider->gambar && file_exists(public_path('uploads/slider/' . $slider->gambar))) {
                unlink(public_path('uploads/slider/' . $slider->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/slider'), $filename);
            $data['gambar'] = $filename;
        }

        $slider->update($data);

        return redirect()->route('admin.slider.index')->with('success', 'Slider berhasil diupdate');
    }

    public function destroy(Slider $slider)
    {
        // Hapus gambar
        if ($slider->gambar && file_exists(public_path('uploads/slider/' . $slider->gambar))) {
            unlink(public_path('uploads/slider/' . $slider->gambar));
        }

        $slider->delete();

        return redirect()->route('admin.slider.index')->with('success', 'Slider berhasil dihapus');
    }
}