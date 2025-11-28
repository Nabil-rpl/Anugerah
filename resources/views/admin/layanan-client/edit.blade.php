@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3">Edit Layanan Client</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.layanan-client.index') }}">Layanan Client</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.layanan-client.update', $layananClient) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('judul') is-invalid @enderror" 
                           id="judul" 
                           name="judul" 
                           value="{{ old('judul', $layananClient->judul) }}" 
                           required
                           maxlength="100"
                           placeholder="Masukkan judul layanan">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label">Isi <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('isi') is-invalid @enderror" 
                              id="isi" 
                              name="isi" 
                              rows="6" 
                              required
                              placeholder="Masukkan deskripsi layanan">{{ old('isi', $layananClient->isi) }}</textarea>
                    @error('isi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    
                    @if($layananClient->gambar)
                        <div class="mb-2">
                            <img src="{{ asset($layananClient->gambar) }}" 
                                 alt="{{ $layananClient->judul }}" 
                                 class="img-thumbnail" 
                                 id="currentImage"
                                 style="max-width: 300px;">
                            <p class="text-muted small mt-1">Gambar saat ini</p>
                        </div>
                    @endif
                    
                    <input type="file" 
                           class="form-control @error('gambar') is-invalid @enderror" 
                           id="gambar" 
                           name="gambar"
                           accept="image/*"
                           onchange="previewImage(event)">
                    <small class="text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                        <p class="text-muted small mt-1">Preview gambar baru</p>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.layanan-client.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const preview = document.getElementById('preview');
        const previewDiv = document.getElementById('imagePreview');
        const currentImage = document.getElementById('currentImage');
        
        preview.src = reader.result;
        previewDiv.style.display = 'block';
        
        // Hide current image when new image is selected
        if (currentImage) {
            currentImage.style.display = 'none';
        }
    }
    
    if (event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}
</script>
@endpush