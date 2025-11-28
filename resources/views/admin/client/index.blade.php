@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Master Client</h1>
        <a href="{{ route('admin.client.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Client
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">No. Pelanggan</th>
                            <th width="18%">Nama Pelanggan</th>
                            <th width="20%">Alamat</th>
                            <th width="12%">Email</th>
                            <th width="12%">No. Telepon</th>
                            <th width="10%">Waktu</th>
                            <th width="11%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($clients->currentPage() - 1) * $clients->perPage() }}</td>
                                <td><span class="badge bg-primary">{{ $item->nomor_pelanggan }}</span></td>
                                <td>{{ $item->nama_pelanggan }}</td>
                                <td>{{ Str::limit($item->alamat, 50) ?? '-' }}</td>
                                <td>{{ $item->email ?? '-' }}</td>
                                <td>{{ $item->nomor_telepon ?? '-' }}</td>
                                <td>{{ $item->waktu->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.client.show', $item->nomor_pelanggan) }}" 
                                           class="btn btn-sm btn-info" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.client.edit', $item->nomor_pelanggan) }}" 
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.client.destroy', $item->nomor_pelanggan) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Yakin ingin menghapus client {{ $item->nama_pelanggan }}?');"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <p class="text-muted mb-0">Belum ada data client</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $clients->links() }}
            </div>
        </div>
    </div>
</div>
@endsection