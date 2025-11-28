@extends('layouts.admin')

@section('title', 'Detail Slider')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detail Slider</h4>
                    <div>
                        <a href="{{ route('admin.slider.edit', $slider->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th width="30%">ID</th>
                                        <td>: {{ $slider->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Judul</th>
                                        <td>: {{ $slider->judul }}</td>
                                    </tr>
                                    <tr>
                                        <th>Isi / Deskripsi</th>
                                        <td>: {{ $slider->isi ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5>Gambar Slider</h5>
                                @if($slider->gambar)
                                    <div class="border p-2 rounded">
                                        <img src="{{ asset('uploads/slider/' . $slider->gambar) }}" 
                                             alt="{{ $slider->judul }}" 
                                             class="img-fluid rounded">
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                <i class="fas fa-file-image"></i> {{ $slider->gambar }}
                                            </small>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle"></i> Tidak ada gambar
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('admin.slider.edit', $slider->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Slider
                        </a>
                        <form action="{{ route('admin.slider.destroy', $slider->id) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus slider ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Hapus Slider
                            </button>
                        </form>
                        <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection