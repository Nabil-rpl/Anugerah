@extends('layouts.admin')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')
@section('page-subtitle', 'Edit berita atau artikel')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="form-container">
                <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Judul -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                   name="judul" value="{{ old('judul', $berita->judul) }}" required 
                                   placeholder="Masukkan judul berita">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sumber -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Sumber Berita</label>
                            <input type="text" class="form-control @error('sumber') is-invalid @enderror" 
                                   name="sumber" value="{{ old('sumber', $berita->sumber) }}"
                                   placeholder="Contoh: Kompas.com, CNN Indonesia, dll">
                            @error('sumber')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Isi Berita -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Isi Berita <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('isi') is-invalid @enderror" 
                                      name="isi" rows="10" required 
                                      placeholder="Tulis isi berita di sini...">{{ old('isi', $berita->isi) }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimal 50 karakter</small>
                        </div>

                        <!-- Gambar -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Gambar Berita</label>
                            
                            @if($berita->gambar)
                                <div class="mb-3">
                                    <label class="form-label text-muted small">Gambar Saat Ini:</label>
                                    <div>
                                        <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" 
                                             alt="{{ $berita->judul }}" 
                                             class="img-thumbnail" 
                                             id="currentImage"
                                             style="max-width: 300px; max-height: 300px; object-fit: cover;">
                                    </div>
                                </div>
                            @endif
                            
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" 
                                   name="gambar" accept="image/*" id="gambarInput" onchange="previewImage(event)">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                            
                            <!-- Preview Image Baru -->
                            <div class="mt-3" id="imagePreview" style="display: none;">
                                <label class="form-label text-muted small">Preview Gambar Baru:</label>
                                <div>
                                    <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 300px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
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
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
                
                // Hide current image when new image is selected
                const currentImage = document.getElementById('currentImage');
                if (currentImage) {
                    currentImage.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection