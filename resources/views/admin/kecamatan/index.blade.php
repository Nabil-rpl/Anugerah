@extends('layouts.admin')

@section('title', 'Data Kecamatan')
@section('page-title', 'Data Kecamatan')
@section('page-subtitle', 'Kelola data kecamatan')

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
                    <h5 class="mb-0">Daftar Kecamatan</h5>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control search-box" placeholder="Cari kecamatan..." id="searchInput">
                        <a href="{{ route('admin.kecamatan.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Kecamatan
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="80">No</th>
                                <th width="150">Kode Kecamatan</th>
                                <th width="120">Kode Kota</th>
                                <th>Nama Kecamatan</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kecamatans as $index => $kecamatan)
                            <tr>
                                <td>{{ $kecamatans->firstItem() + $index }}</td>
                                <td><span class="badge bg-primary">{{ $kecamatan->kode_kecamatan }}</span></td>
                                <td><span class="badge bg-info">{{ $kecamatan->kode_kota }}</span></td>
                                <td>{{ $kecamatan->nama_kecamatan }}</td>
                                <td>
                                    <a href="{{ route('admin.kecamatan.show', $kecamatan->kode_kecamatan) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.kecamatan.edit', $kecamatan->kode_kecamatan) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $kecamatan->kode_kecamatan }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $kecamatan->kode_kecamatan }}" action="{{ route('admin.kecamatan.destroy', $kecamatan->kode_kecamatan) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <p class="text-muted">Tidak ada data kecamatan</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $kecamatans->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function confirmDelete(kode) {
        if (confirm('Apakah Anda yakin ingin menghapus kecamatan ini?')) {
            document.getElementById('delete-form-' + kode).submit();
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

    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
</script>
@endsection