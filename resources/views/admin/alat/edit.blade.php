@extends('layouts.admin')

@section('title', 'Edit Alat')
@section('page-title', 'Edit Alat')
@section('page-subtitle', 'Form edit alat')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-warning">
                    <h5 class="mb-0"><i class="bi bi-pencil"></i> Form Edit Alat</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.alat.update', $alat->idalat) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="idalat" class="form-label">ID Alat</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="idalat" 
                                   value="{{ $alat->idalat }}" 
                                   disabled>
                            <small class="text-muted">ID alat tidak dapat diubah</small>
                        </div>

                        <div class="mb-3">
                            <label for="namaalat" class="form-label">
                                Nama Alat <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('namaalat') is-invalid @enderror" 
                                   id="namaalat" 
                                   name="namaalat" 
                                   value="{{ old('namaalat', $alat->namaalat) }}" 
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
                                            {{ old('kodekategorialat', $alat->kodekategorialat) == $kategori->kodekategori ? 'selected' : '' }}>
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
                                           value="{{ old('kodesatuan', $alat->kodesatuan) }}" 
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
                                           value="{{ old('jumlah', $alat->jumlah) }}" 
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
                                      placeholder="Masukkan keterangan alat (opsional)">{{ old('keterangan', $alat->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.alat.index') }}" class="btn btn-secondary">
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