@extends('layouts.admin')

@section('title', 'Edit Slider')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Slider</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" 
                                   name="judul" 
                                   value="{{ old('judul', $slider->judul) }}" 
                                   placeholder="Masukkan judul slider"
                                   maxlength="100"
                                   required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="isi" class="form-label">Isi / Deskripsi</label>
                            <textarea class="form-control @error('isi') is-invalid @enderror" 
                                      id="isi" 
                                      name="isi" 
                                      rows="4"
                                      placeholder="Masukkan deskripsi slider (opsional)">{{ old('isi', $slider->isi) }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            
                            @if($slider->gambar)
                                <div class="mb-2">
                                    <label class="form-label d-block">Gambar Saat Ini:</label>
                                    <img src="{{ asset('uploads/slider/' . $slider->gambar) }}" 
                                         alt="{{ $slider->judul }}" 
                                         class="img-thumbnail"
                                         style="max-width: 300px;">
                                </div>
                            @endif
                            
                            <input type="file" 
                                   class="form-control @error('gambar') is-invalid @enderror" 
                                   id="gambar" 
                                   name="gambar"
                                   accept="image/jpeg,image/png,image/jpg,image/gif"
                                   onchange="previewImage(event)">
                            <small class="form-text text-muted">
                                Format: JPG, JPEG, PNG, GIF. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah gambar.
                            </small>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <label class="form-label">Preview Gambar Baru:</label>
                                <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary">
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