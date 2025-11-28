@extends('layouts.admin')

@section('title', 'Data Berita')
@section('page-title', 'Data Berita')
@section('page-subtitle', 'Kelola berita dan artikel')

@section('styles')
<style>
    .search-box {
        max-width: 300px;
    }
</style>
@endsection

@section('content')
    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Berita Table -->
    <div class="row">
        <div class="col-12">
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Daftar Berita</h5>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control" placeholder="Cari berita..." id="searchInput" style="max-width: 300px;">
                        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Berita
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 80px;">Gambar</th>
                                <th>Judul</th>
                                <th>Sumber</th>
                                <th style="width: 180px;">Tanggal</th>
                                <th style="width: 200px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($berita as $item)
                            <tr>
                                <td>
                                    @if($item->gambar)
                                        <img src="{{ asset('uploads/berita/' . $item->gambar) }}" 
                                             alt="{{ $item->judul }}" 
                                             class="img-thumbnail" 
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 60px; border-radius: 4px;">
                                            <i class="bi bi-image fs-4"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ Str::limit($item->judul, 50) }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($item->isi, 80) }}</small>
                                </td>
                                <td>{{ $item->sumber ?? '-' }}</td>
                                <td>{{ $item->tanggal ? $item->tanggal->format('d M Y H:i') : '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.berita.show', $item->id) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $item->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <p class="text-muted">Tidak ada data berita</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-3">
                    {{ $berita->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Confirm Delete
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus berita ini? Gambar juga akan dihapus.')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
</script>
@endsection