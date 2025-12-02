@extends('layouts.admin')

@section('title', 'Tambah Kota')
@section('page-title', 'Tambah Kota')
@section('page-subtitle', 'Tambah data kota/kabupaten baru')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Form Tambah Kota</h5>
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

                    <form action="{{ route('admin.kota.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="kode_kota" class="form-label">
                                Kode Kota <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('kode_kota') is-invalid @enderror" 
                                   id="kode_kota" 
                                   name="kode_kota" 
                                   value="{{ old('kode_kota') }}"
                                   maxlength="4"
                                   placeholder="Contoh: 3201"
                                   required>
                            <small class="form-text text-muted">
                                Masukkan kode kota 4 digit
                            </small>
                            @error('kode_kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                                            {{ old('kode_provinsi') == $provinsi->kode_provinsi ? 'selected' : '' }}>
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
                                   value="{{ old('nama_kota') }}"
                                   placeholder="Contoh: Kabupaten Bandung"
                                   required>
                            @error('nama_kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.kota.index') }}" class="btn btn-secondary">
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

@section('scripts')
<script>
    // Auto-format kode_kota to uppercase
    document.getElementById('kode_kota').addEventListener('input', function(e) {
        this.value = this.value.toUpperCase();
    });
</script>
@endsection