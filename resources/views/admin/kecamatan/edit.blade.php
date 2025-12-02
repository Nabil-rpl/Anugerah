@extends('layouts.admin')

@section('title', 'Edit Kecamatan')
@section('page-title', 'Edit Kecamatan')
@section('page-subtitle', 'Form edit kecamatan')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-warning">
                    <h5 class="mb-0"><i class="bi bi-pencil"></i> Form Edit Kecamatan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.kecamatan.update', $kecamatan->kode_kecamatan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="kode_kecamatan" class="form-label">Kode Kecamatan</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="kode_kecamatan" 
                                   value="{{ $kecamatan->kode_kecamatan }}" 
                                   disabled>
                            <small class="text-muted">Kode kecamatan tidak dapat diubah</small>
                        </div>

                        <div class="mb-3">
                            <label for="kode_kota" class="form-label">
                                Kode Kota <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('kode_kota') is-invalid @enderror" 
                                   id="kode_kota" 
                                   name="kode_kota" 
                                   value="{{ old('kode_kota', $kecamatan->kode_kota) }}" 
                                   placeholder="Contoh: 3273"
                                   maxlength="4"
                                   required>
                            @error('kode_kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: 4 digit angka</small>
                        </div>

                        <div class="mb-3">
                            <label for="nama_kecamatan" class="form-label">
                                Nama Kecamatan <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama_kecamatan') is-invalid @enderror" 
                                   id="nama_kecamatan" 
                                   name="nama_kecamatan" 
                                   value="{{ old('nama_kecamatan', $kecamatan->nama_kecamatan) }}" 
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
                                <i class="bi bi-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection