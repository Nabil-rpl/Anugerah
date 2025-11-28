@extends('layouts.admin')

@section('title', 'Edit Kategori Alat')
@section('page-title', 'Edit Kategori Alat')
@section('page-subtitle', 'Form edit kategori alat')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-warning">
                    <h5 class="mb-0"><i class="bi bi-pencil"></i> Form Edit Kategori</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.kategori-alat.update', $kategoriAlat->kodekategori) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="kodekategori" class="form-label">Kode Kategori</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="kodekategori" 
                                   value="{{ $kategoriAlat->kodekategori }}" 
                                   disabled>
                            <small class="text-muted">Kode kategori tidak dapat diubah</small>
                        </div>

                        <div class="mb-3">
                            <label for="namakategori" class="form-label">
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('namakategori') is-invalid @enderror" 
                                   id="namakategori" 
                                   name="namakategori" 
                                   value="{{ old('namakategori', $kategoriAlat->namakategori) }}" 
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
                                      placeholder="Masukkan keterangan kategori (opsional)">{{ old('keterangan', $kategoriAlat->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.kategori-alat.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection