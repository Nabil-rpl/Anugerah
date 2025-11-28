@extends('layouts.admin')

@section('title', 'Master Jenis Layanan')
@section('page-title', 'Master Jenis Layanan')
@section('page-subtitle', 'Kelola jenis layanan')

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

    <!-- Jenis Layanan Table -->
    <div class="row">
        <div class="col-12">
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Daftar Jenis Layanan</h5>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control" placeholder="Cari layanan..." id="searchInput" style="max-width: 300px;">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="bi bi-plus-circle"></i> Tambah Jenis Layanan
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 100px;">ID</th>
                                <th>Nama Layanan</th>
                                <th style="width: 150px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jenisLayanan as $item)
                            <tr>
                                <td>{{ $item->id_jenislayanan }}</td>
                                <td>{{ $item->nama_layanan }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_jenislayanan }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $item->id_jenislayanan }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $item->id_jenislayanan }}" action="{{ route('admin.jenis-layanan.destroy', $item->id_jenislayanan) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $item->id_jenislayanan }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.jenis-layanan.update', $item->id_jenislayanan) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Jenis Layanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">ID Jenis Layanan</label>
                                                    <input type="text" class="form-control" value="{{ $item->id_jenislayanan }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Layanan <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('nama_layanan') is-invalid @enderror" 
                                                           name="nama_layanan" value="{{ old('nama_layanan', $item->nama_layanan) }}" 
                                                           required maxlength="20">
                                                    @error('nama_layanan')
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
                                    <p class="text-muted">Tidak ada data jenis layanan</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-3">
                    {{ $jenisLayanan->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.jenis-layanan.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jenis Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">ID Jenis Layanan <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('id_jenislayanan') is-invalid @enderror" 
                               name="id_jenislayanan" value="{{ old('id_jenislayanan') }}" 
                               required min="1" max="127"
                               placeholder="Masukkan ID (1-127)">
                        @error('id_jenislayanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">ID harus unik, range 1-127 (tinyInteger)</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Layanan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_layanan') is-invalid @enderror" 
                               name="nama_layanan" value="{{ old('nama_layanan') }}" 
                               required maxlength="20" 
                               placeholder="Contoh: Surat Keterangan, Izin Usaha">
                        @error('nama_layanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Maksimal 20 karakter</small>
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
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus jenis layanan ini?')) {
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