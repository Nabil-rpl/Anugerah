@extends('layouts.admin')

@section('title', 'Data Kategori Alat')
@section('page-title', 'Data Kategori Alat')
@section('page-subtitle', 'Kelola data kategori alat')

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

    <!-- Kategori Alat Table -->
    <div class="row">
        <div class="col-12">
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Daftar Kategori Alat</h5>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control search-box" placeholder="Cari kategori..." id="searchInput">
                        <a href="{{ route('admin.kategori-alat.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Kategori
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="100">Kode</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoris as $kategori)
                            <tr>
                                <td>{{ $kategori->kodekategori }}</td>
                                <td>{{ $kategori->namakategori }}</td>
                                <td>{{ Str::limit($kategori->keterangan, 50) ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.kategori-alat.show', $kategori->kodekategori) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.kategori-alat.edit', $kategori->kodekategori) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $kategori->kodekategori }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $kategori->kodekategori }}" action="{{ route('admin.kategori-alat.destroy', $kategori->kodekategori) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <p class="text-muted">Tidak ada data kategori alat</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Confirm Delete
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
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