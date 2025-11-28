@extends('layouts.admin')

@section('title', 'Data Alat')
@section('page-title', 'Data Alat')
@section('page-subtitle', 'Kelola data alat')

@section('content')
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

    <div class="row">
        <div class="col-12">
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Daftar Alat</h5>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control search-box" placeholder="Cari alat..." id="searchInput">
                        <a href="{{ route('admin.alat.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Alat
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="80">ID</th>
                                <th>Nama Alat</th>
                                <th>Kategori</th>
                                <th width="100">Jumlah</th>
                                <th>Keterangan</th>
                                <th width="150">Waktu</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alats as $alat)
                            <tr>
                                <td>{{ $alat->idalat }}</td>
                                <td>{{ $alat->namaalat }}</td>
                                <td>
                                    @if($alat->kategori)
                                        <span class="badge bg-info">{{ $alat->kategori->namakategori }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $alat->jumlah ?? 0 }}</td>
                                <td>{{ Str::limit($alat->keterangan, 30) ?? '-' }}</td>
                                <td>{{ $alat->waktu ? $alat->waktu->format('d M Y H:i') : '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.alat.show', $alat->idalat) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.alat.edit', $alat->idalat) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $alat->idalat }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $alat->idalat }}" action="{{ route('admin.alat.destroy', $alat->idalat) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <p class="text-muted">Tidak ada data alat</p>
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
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus alat ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }

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