@extends('layouts.admin')

@section('title', 'Detail Berita')
@section('page-title', 'Detail Berita')
@section('page-subtitle', 'Informasi lengkap berita')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="detail-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">
                        <i class="bi bi-newspaper"></i> {{ $berita->judul }}
                    </h5>
                </div>

                <div class="row">
                    <!-- Gambar Berita -->
                    @if($berita->gambar)
                    <div class="col-md-12 mb-4">
                        <div class="text-center">
                            <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" 
                                 alt="{{ $berita->judul }}" 
                                 class="img-fluid rounded shadow-sm" 
                                 style="max-width: 100%; max-height: 500px; object-fit: contain;">
                        </div>
                    </div>
                    @endif

                    <div class="col-md-6">
                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="bi bi-hash"></i> ID Berita
                            </div>
                            <div class="detail-value">{{ $berita->id }}</div>
                        </div>

                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="bi bi-card-heading"></i> Judul
                            </div>
                            <div class="detail-value">{{ $berita->judul }}</div>
                        </div>

                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="bi bi-link-45deg"></i> Sumber
                            </div>
                            <div class="detail-value">{{ $berita->sumber ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="bi bi-calendar"></i> Tanggal Publikasi
                            </div>
                            <div class="detail-value">
                                {{ $berita->tanggal ? $berita->tanggal->format('d F Y, H:i') : '-' }}
                            </div>
                        </div>

                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="bi bi-image"></i> Gambar
                            </div>
                            <div class="detail-value">
                                @if($berita->gambar)
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Ada Gambar
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-x-circle"></i> Tidak Ada Gambar
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Isi Berita -->
                    <div class="col-md-12 mt-3">
                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="bi bi-file-text"></i> Isi Berita
                            </div>
                            <div class="detail-value" style="text-align: justify; line-height: 1.8;">
                                {{ $berita->isi }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-end mt-4">
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <button class="btn btn-danger" onclick="confirmDelete()">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                    <form id="delete-form" action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function confirmDelete() {
        if (confirm('Apakah Anda yakin ingin menghapus berita ini? Gambar juga akan dihapus.')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection