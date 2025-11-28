@extends('layouts.admin')

@section('title', 'Tambah Logo Client')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Tambah Logo Client Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.logo-client.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('nama_perusahaan') is-invalid @enderror" 
                                   id="nama_perusahaan" 
                                   name="nama_perusahaan" 
                                   value="{{ old('nama_perusahaan') }}" 
                                   placeholder="Masukkan nama perusahaan"
                                   maxlength="50"
                                   required>
                            @error('nama_perusahaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar_logo" class="form-label">Logo Perusahaan <span class="text-danger">*</span></label>
                            <input type="file" 
                                   class="form-control @error('gambar_logo') is-invalid @enderror" 
                                   id="gambar_logo" 
                                   name="gambar_logo"
                                   accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml"
                                   onchange="previewImage(event)"
                                   required>
                            <small class="form-text text-muted">
                                Format: JPG, JPEG, PNG, GIF, SVG. Maksimal 2MB. Disarankan logo dengan background transparan (PNG).
                            </small>
                            @error('gambar_logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.logo-client.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const preview = document.getElementById('preview');
        const previewDiv = document.getElementById('imagePreview');
        preview.src = reader.result;
        previewDiv.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection