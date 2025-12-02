@extends('layouts.admin')

@section('title', 'Edit Kota')
@section('page-title', 'Edit Kota')
@section('page-subtitle', 'Edit data kota/kabupaten')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0"><i class="bi bi-pencil"></i> Form Edit Kota</h5>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="bi bi-exclamation-circle"></i> Terdapat kesalahan!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.kota.update', $kota->kode_kota) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="kode_kota" class="form-label">
                                Kode Kota <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control bg-light" 
                                   id="kode_kota" 
                                   value="{{ $kota->kode_kota }}"
                                   disabled>
                            <small class="form-text text-muted">
                                Kode kota tidak dapat diubah
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="kode_provinsi" class="form-label">
                                Provinsi <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('kode_provinsi') is-invalid @enderror" 
                                    id="kode_provinsi" 
                                    name="kode_provinsi" 
                                    required>
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach($provinsis as $provinsi)
                                    <option value="{{ $provinsi->kode_provinsi }}" 
                                            {{ (old('kode_provinsi', $kota->kode_provinsi) == $provinsi->kode_provinsi) ? 'selected' : '' }}>
                                        {{ $provinsi->nama_provinsi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kode_provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_kota" class="form-label">
                                Nama Kota <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama_kota') is-invalid @enderror" 
                                   id="nama_kota" 
                                   name="nama_kota" 
                                   value="{{ old('nama_kota', $kota->nama_kota) }}"
                                   placeholder="Contoh: Kabupaten Bandung"
                                   required>
                            @error('nama_kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <strong>Informasi:</strong> Kota ini memiliki 
                            <strong>{{ $kota->kecamatans->count() }} kecamatan</strong> terkait.
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.kota.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <div>
                                <a href="{{ route('admin.kota.show', $kota->kode_kota) }}" class="btn btn-info">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-save"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection