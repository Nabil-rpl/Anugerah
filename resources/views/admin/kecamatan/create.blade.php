@extends('layouts.admin')

@section('title', 'Tambah Kecamatan')
@section('page-title', 'Tambah Kecamatan')
@section('page-subtitle', 'Form tambah kecamatan baru')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Form Tambah Kecamatan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.kecamatan.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="kode_kecamatan" class="form-label">
                                Kode Kecamatan <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('kode_kecamatan') is-invalid @enderror" 
                                   id="kode_kecamatan" 
                                   name="kode_kecamatan" 
                                   value="{{ old('kode_kecamatan') }}" 
                                   placeholder="Contoh: 3273010"
                                   maxlength="7"
                                   required>
                            @error('kode_kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: 7 digit angka (contoh: 3273010)</small>
                        </div>

                        <div class="mb-3">
                            <label for="kode_kota" class="form-label">
                                Kode Kota <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('kode_kota') is-invalid @enderror" 
                                   id="kode_kota" 
                                   name="kode_kota" 
                                   value="{{ old('kode_kota') }}" 
                                   placeholder="Contoh: 3273"
                                   maxlength="4"
                                   required>
                            @error('kode_kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: 4 digit angka (contoh: 3273)</small>
                        </div>

                        <div class="mb-3">
                            <label for="nama_kecamatan" class="form-label">
                                Nama Kecamatan <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama_kecamatan') is-invalid @enderror" 
                                   id="nama_kecamatan" 
                                   name="nama_kecamatan" 
                                   value="{{ old('nama_kecamatan') }}" 
                                   placeholder="Contoh: Bandung Wetan"
                                   maxlength="255"
                                   required>
                            @error('nama_kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.kecamatan.index') }}" class="btn btn-secondary">
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