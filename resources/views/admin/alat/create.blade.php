@extends('layouts.admin')

@section('title', 'Tambah Alat')
@section('page-title', 'Tambah Alat')
@section('page-subtitle', 'Form tambah alat baru')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Form Tambah Alat</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.alat.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="namaalat" class="form-label">
                                Nama Alat <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('namaalat') is-invalid @enderror" 
                                   id="namaalat" 
                                   name="namaalat" 
                                   value="{{ old('namaalat') }}" 
                                   placeholder="Masukkan nama alat"
                                   maxlength="100"
                                   required>
                            @error('namaalat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kodekategorialat" class="form-label">Kategori Alat</label>
                            <select class="form-select @error('kodekategorialat') is-invalid @enderror" 
                                    id="kodekategorialat" 
                                    name="kodekategorialat">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->kodekategori }}" 
                                            {{ old('kodekategorialat') == $kategori->kodekategori ? 'selected' : '' }}>
                                        {{ $kategori->namakategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kodekategorialat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kodesatuan" class="form-label">Kode Satuan</label>
                                    <input type="number" 
                                           class="form-control @error('kodesatuan') is-invalid @enderror" 
                                           id="kodesatuan" 
                                           name="kodesatuan" 
                                           value="{{ old('kodesatuan') }}" 
                                           placeholder="Masukkan kode satuan">
                                    @error('kodesatuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" 
                                           class="form-control @error('jumlah') is-invalid @enderror" 
                                           id="jumlah" 
                                           name="jumlah" 
                                           value="{{ old('jumlah') }}" 
                                           placeholder="Masukkan jumlah">
                                    @error('jumlah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                      id="keterangan" 
                                      name="keterangan" 
                                      rows="4"
                                      placeholder="Masukkan keterangan alat (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.alat.index') }}" class="btn btn-secondary">
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