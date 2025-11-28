@extends('layouts.admin')

@section('title', 'Tambah Kategori Alat')
@section('page-title', 'Tambah Kategori Alat')
@section('page-subtitle', 'Form tambah kategori alat baru')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Form Tambah Kategori</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.kategori-alat.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="namakategori" class="form-label">
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('namakategori') is-invalid @enderror" 
                                   id="namakategori" 
                                   name="namakategori" 
                                   value="{{ old('namakategori') }}" 
                                   placeholder="Masukkan nama kategori"
                                   maxlength="50"
                                   required>
                            @error('namakategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                      id="keterangan" 
                                      name="keterangan" 
                                      rows="4"
                                      placeholder="Masukkan keterangan kategori (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.kategori-alat.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection