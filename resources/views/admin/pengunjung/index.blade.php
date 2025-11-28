@extends('layouts.admin')

@section('title', 'Data Pengunjung')
@section('page-title', 'Data Pengunjung')
@section('page-subtitle', 'Kelola data pengunjung')

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

    <!-- Pengunjung Table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="table-container">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Daftar Pengunjung</h5>
                                    <div class="d-flex gap-2">
                                        <input type="text" class="form-control search-box" placeholder="Cari pengunjung..." id="searchInput">
                                        <a href="{{ route('admin.pengunjung.create') }}" class="btn btn-primary">
                                            <i class="bi bi-plus-circle"></i> Tambah Pengunjung
                                        </a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Lengkap</th>
                                                <th>Email</th>
                                                <th>No. Telepon</th>
                                                <th>Lokasi</th>
                                                <th>Waktu</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($pengunjung as $item)
                                            <tr>
                                                <td>{{ $item->id_pengunjung }}</td>
                                                <td>{{ $item->nama_lengkap }}</td>
                                                <td>{{ $item->email ?? '-' }}</td>
                                                <td>{{ $item->nomor_telepon ?? '-' }}</td>
                                                <td>{{ $item->lokasi_pengisi ?? '-' }}</td>
                                                <td>{{ $item->waktu ? $item->waktu->format('d M Y H:i') : '-' }}</td>
                                                <td>
                                                    <form action="{{ route('admin.pengunjung.toggle-status', $item->id_pengunjung) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm {{ $item->status ? 'btn-success' : 'btn-secondary' }} badge-status" style="border: none;">
                                                            @if($item->status)
                                                                <i class="bi bi-check-circle"></i> Aktif
                                                            @else
                                                                <i class="bi bi-x-circle"></i> Tidak Aktif
                                                            @endif
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.pengunjung.show', $item->id_pengunjung) }}" class="btn btn-sm btn-outline-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.pengunjung.edit', $item->id_pengunjung) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $item->id_pengunjung }})">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                    <form id="delete-form-{{ $item->id_pengunjung }}" action="{{ route('admin.pengunjung.destroy', $item->id_pengunjung) }}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-4">
                                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                                    <p class="text-muted">Tidak ada data pengunjung</p>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Pagination -->
                                <div class="mt-3">
                                    {{ $pengunjung->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Confirm Delete
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data pengunjung ini?')) {
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