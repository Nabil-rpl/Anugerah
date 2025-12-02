@extends('layouts.admin')

@section('title', 'Daftar Kota')
@section('page-title', 'Daftar Kota')
@section('page-subtitle', 'Kelola data kota/kabupaten')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-building"></i> Daftar Kota/Kabupaten</h5>
                        <a href="{{ route('admin.kota.create') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-plus-circle"></i> Tambah Kota
                        </a>
                    </div>
                </div>
                <div class="card-body">
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

                    <!-- Filter -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form action="{{ route('admin.kota.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Cari kota..." 
                                           value="{{ request('search') }}">
                                    <button class="btn btn-outline-primary" type="submit">
                                        <i class="bi bi-search"></i> Cari
                                    </button>
                                    @if(request('search'))
                                        <a href="{{ route('admin.kota.index') }}" class="btn btn-outline-secondary">
                                            <i class="bi bi-x-circle"></i> Reset
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Kode Kota</th>
                                    <th width="20%">Provinsi</th>
                                    <th width="35%">Nama Kota</th>
                                    <th width="10%" class="text-center">Kecamatan</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kotas as $index => $kota)
                                    <tr>
                                        <td>{{ $kotas->firstItem() + $index }}</td>
                                        <td><span class="badge bg-primary">{{ $kota->kode_kota }}</span></td>
                                        <td>
                                            @if($kota->provinsi)
                                                {{ $kota->provinsi->nama_provinsi }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $kota->nama_kota }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-success">{{ $kota->kecamatans->count() }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.kota.show', $kota->kode_kota) }}" 
                                                   class="btn btn-info" title="Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.kota.edit', $kota->kode_kota) }}" 
                                                   class="btn btn-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button class="btn btn-danger" 
                                                        onclick="confirmDelete('{{ $kota->kode_kota }}')"
                                                        title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                            <form id="delete-form-{{ $kota->kode_kota }}" 
                                                  action="{{ route('admin.kota.destroy', $kota->kode_kota) }}" 
                                                  method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                            <p class="text-muted mt-2">Tidak ada data kota</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Menampilkan {{ $kotas->firstItem() ?? 0 }} - {{ $kotas->lastItem() ?? 0 }} 
                            dari {{ $kotas->total() }} data
                        </div>
                        <div>
                            {{ $kotas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function confirmDelete(kode) {
        if (confirm('Apakah Anda yakin ingin menghapus kota ini? Data kecamatan terkait mungkin akan terpengaruh.')) {
            document.getElementById('delete-form-' + kode).submit();
        }
    }
</script>
@endsection