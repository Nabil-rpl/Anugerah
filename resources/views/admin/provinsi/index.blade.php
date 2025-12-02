@extends('layouts.admin')

@section('title', 'Master Provinsi')
@section('page-title', 'Master Provinsi')
@section('page-subtitle', 'Kelola data provinsi Indonesia')

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

    <!-- Provinsi Table -->
    <div class="row">
        <div class="col-12">
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Daftar Provinsi</h5>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control" placeholder="Cari provinsi..." id="searchInput" style="max-width: 300px;">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="bi bi-plus-circle"></i> Tambah Provinsi
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 150px;">Kode Provinsi</th>
                                <th>Nama Provinsi</th>
                                <th style="width: 150px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($provinsi as $item)
                            <tr>
                                <td><span class="badge bg-primary">{{ $item->kode_provinsi }}</span></td>
                                <td><strong>{{ $item->nama_provinsi }}</strong></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->kode_provinsi }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $item->kode_provinsi }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $item->kode_provinsi }}" action="{{ route('admin.provinsi.destroy', $item->kode_provinsi) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $item->kode_provinsi }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.provinsi.update', $item->kode_provinsi) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Provinsi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Kode Provinsi</label>
                                                    <input type="text" class="form-control" value="{{ $item->kode_provinsi }}" disabled>
                                                    <small class="text-muted">Kode tidak dapat diubah</small>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Provinsi <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('nama_provinsi') is-invalid @enderror" 
                                                           name="nama_provinsi" value="{{ old('nama_provinsi', $item->nama_provinsi) }}" 
                                                           required maxlength="255">
                                                    @error('nama_provinsi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <p class="text-muted">Tidak ada data provinsi</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-3">
                    {{ $provinsi->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.provinsi.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Provinsi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Kode Provinsi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode_provinsi') is-invalid @enderror" 
                                   name="kode_provinsi" value="{{ old('kode_provinsi') }}" 
                                   required maxlength="2" 
                                   placeholder="Contoh: 11, 12, 13"
                                   style="text-transform: uppercase;">
                            @error('kode_provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">2 digit kode provinsi (contoh: 11 untuk Aceh)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Provinsi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_provinsi') is-invalid @enderror" 
                                   name="nama_provinsi" value="{{ old('nama_provinsi') }}" 
                                   required maxlength="255" 
                                   placeholder="Contoh: DKI Jakarta">
                            @error('nama_provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Confirm Delete
    function confirmDelete(kode) {
        if (confirm('Apakah Anda yakin ingin menghapus provinsi ini?')) {
            document.getElementById('delete-form-' + kode).submit();
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

    // Auto uppercase kode provinsi
    document.querySelector('input[name="kode_provinsi"]').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });
</script>
@endsection