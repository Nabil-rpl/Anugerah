@extends('layouts.admin')

@section('title', 'Manajemen Sub Layanan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Data Sub Layanan</h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                            <i class="fas fa-plus"></i> Tambah Sub Layanan
                        </button>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="tableSubLayanan">
                                <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th>ID</th>
                                        <th>Nama Sub Layanan</th>
                                        <th>Jenis Layanan</th>
                                        <th>Jumlah Hama</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sublayanan as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->id_sublayanan }}</td>
                                            <td>{{ $item->nama_sublayanan }}</td>
                                            <td>
                                                @if ($item->jenisLayanan)
                                                    <span class="badge bg-info">{{ $item->jenisLayanan->nama_layanan }}</span>
                                                @else
                                                    <span class="badge bg-secondary">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ $item->hama->count() }} Hama</span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit{{ $item->id_sublayanan }}" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapus{{ $item->id_sublayanan }}" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="modalEdit{{ $item->id_sublayanan }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.sublayanan.update', $item->id_sublayanan) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Sub Layanan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="nama_sublayanan_edit{{ $item->id_sublayanan }}" class="form-label">
                                                                    Nama Sub Layanan <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control" 
                                                                    id="nama_sublayanan_edit{{ $item->id_sublayanan }}" 
                                                                    name="nama_sublayanan"
                                                                    value="{{ old('nama_sublayanan', $item->nama_sublayanan) }}"
                                                                    maxlength="30" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="id_layanan_edit{{ $item->id_sublayanan }}" class="form-label">
                                                                    Jenis Layanan
                                                                </label>
                                                                <select class="form-select" 
                                                                    id="id_layanan_edit{{ $item->id_sublayanan }}" 
                                                                    name="id_layanan">
                                                                    <option value="">-- Pilih Jenis Layanan --</option>
                                                                    @foreach ($jenisLayanan as $jenis)
                                                                        <option value="{{ $jenis->id_jenislayanan }}"
                                                                            {{ old('id_layanan', $item->id_layanan) == $jenis->id_jenislayanan ? 'selected' : '' }}>
                                                                            {{ $jenis->nama_layanan }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
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

                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="modalHapus{{ $item->id_sublayanan }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.sublayanan.destroy', $item->id_sublayanan) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Hapus Sub Layanan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menghapus sub layanan <strong>{{ $item->nama_sublayanan }}</strong>?</p>
                                                            
                                                            @if ($item->hama->count() > 0)
                                                                <div class="alert alert-danger">
                                                                    <i class="fas fa-exclamation-triangle"></i>
                                                                    Sub layanan ini digunakan oleh <strong>{{ $item->hama->count() }} hama</strong>!
                                                                    <br>Tidak dapat dihapus.
                                                                </div>
                                                            @else
                                                                <div class="alert alert-warning mt-3">
                                                                    <i class="fas fa-exclamation-triangle"></i>
                                                                    Data yang sudah dihapus tidak dapat dikembalikan!
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger" 
                                                                {{ $item->hama->count() > 0 ? 'disabled' : '' }}>
                                                                Hapus
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data sub layanan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.sublayanan.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Sub Layanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_sublayanan" class="form-label">
                                Nama Sub Layanan <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('nama_sublayanan') is-invalid @enderror"
                                id="nama_sublayanan" name="nama_sublayanan" value="{{ old('nama_sublayanan') }}"
                                placeholder="Contoh: Fumigasi, Fogging, Sanitasi" maxlength="30" required>
                            @error('nama_sublayanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Maksimal 30 karakter</small>
                        </div>
                        <div class="mb-3">
                            <label for="id_layanan" class="form-label">Jenis Layanan</label>
                            <select class="form-select @error('id_layanan') is-invalid @enderror" 
                                id="id_layanan" name="id_layanan">
                                <option value="">-- Pilih Jenis Layanan --</option>
                                @forelse($jenisLayanan as $jenis)
                                    <option value="{{ $jenis->id_jenislayanan }}"
                                        {{ old('id_layanan') == $jenis->id_jenislayanan ? 'selected' : '' }}>
                                        {{ $jenis->nama_layanan }}
                                    </option>
                                @empty
                                    <option value="" disabled>Tidak ada jenis layanan</option>
                                @endforelse
                            </select>
                            @error('id_layanan')
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tableSubLayanan').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                "order": [[1, "asc"]]
            });

            // Auto hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
@endpush