@extends('layouts.admin')

@section('title', 'Edit Logo Client')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Logo Client</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.logo-client.update', $logoClient->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('nama_perusahaan') is-invalid @enderror" 
                                   id="nama_perusahaan" 
                                   name="nama_perusahaan" 
                                   value="{{ old('nama_perusahaan', $logoClient->nama_perusahaan) }}" 
                                   placeholder="Masukkan nama perusahaan"
                                   maxlength="50"
                                   required>
                            @error('nama_perusahaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar_logo" class="form-label">Logo Perusahaan</label>
                            
                            @if($logoClient->gambar_logo)
                                <div class="mb-2">
                                    <label class="form-label d-block">Logo Saat Ini:</label>
                                    <img src="{{ asset('uploads/logo-client/' . $logoClient->gambar_logo) }}" 
                                         alt="{{ $logoClient->nama_perusahaan }}" 
                                         class="img-thumbnail"
                                         style="max-width: 300px;">
                                </div>
                            @endif
                            
                            <input type="file" 
                                   class="form-control @error('gambar_logo') is-invalid @enderror" 
                                   id="gambar_logo" 
                                   name="gambar_logo"
                                   accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml"
                                   onchange="previewImage(event)">
                            <small class="form-text text-muted">
                                Format: JPG, JPEG, PNG, GIF, SVG. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah logo.
                            </small>
                            @error('gambar_logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <label class="form-label">Preview Logo Baru:</label>
                                <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
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