@extends('layouts.admin')

@section('title', 'Kelola Slider')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Kelola Slider</h4>
                    <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Slider
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($sliders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="15%">Gambar</th>
                                        <th width="25%">Judul</th>
                                        <th width="35%">Isi</th>
                                        <th width="20%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sliders as $index => $slider)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if($slider->gambar)
                                                    <img src="{{ asset('uploads/slider/' . $slider->gambar) }}" 
                                                         alt="{{ $slider->judul }}" 
                                                         class="img-thumbnail"
                                                         style="max-width: 100px; height: auto;">
                                                @else
                                                    <span class="badge bg-secondary">Tidak ada gambar</span>
                                                @endif
                                            </td>
                                            <td>{{ $slider->judul }}</td>
                                            <td>{{ Str::limit($slider->isi, 100) }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.slider.show', $slider->id) }}" 
                                                       class="btn btn-sm btn-info" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.slider.edit', $slider->id) }}" 
                                                       class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.slider.destroy', $slider->id) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Yakin ingin menghapus slider ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle"></i> Belum ada data slider. 
                            <a href="{{ route('admin.slider.create') }}">Tambah slider pertama</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection