@extends('layouts.admin')

@section('title', 'Manajemen Hama')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Data Hama</h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                            <i class="fas fa-plus"></i> Tambah Hama
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
                            <table class="table table-bordered table-striped" id="tableHama">
                                <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th>ID Hama</th>
                                        <th>Nama Hama</th>
                                        <th>Sub Layanan</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($hama as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->id_hama }}</td>
                                            <td>{{ $item->nama_hama }}</td>
                                            <td>
                                                @if ($item->sublayanan)
                                                    <span
                                                        class="badge bg-info">{{ $item->sublayanan->nama_sublayanan }}</span>
                                                @else
                                                    <span class="badge bg-secondary">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.hama.show', $item->id_hama) }}"
                                                    class="btn btn-sm btn-info" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit{{ $item->id_hama }}" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapus{{ $item->id_hama }}" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data hama</td>
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
                <form action="{{ route('admin.hama.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Hama</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_hama" class="form-label">Nama Hama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_hama') is-invalid @enderror"
                                id="nama_hama" name="nama_hama" value="{{ old('nama_hama') }}"
                                placeholder="Contoh: Tikus, Kecoa, Nyamuk" required>
                            @error('nama_hama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_sublayanan" class="form-label">Sub Layanan</label>
                            <select class="form-select @error('id_sublayanan') is-invalid @enderror" id="id_sublayanan"
                                name="id_sublayanan">
                                <option value="">-- Pilih Sub Layanan --</option>
                                @forelse($sublayanan as $sub)
                                    <option value="{{ $sub->id_sublayanan }}"
                                        {{ old('id_sublayanan') == $sub->id_sublayanan ? 'selected' : '' }}>
                                        {{ $sub->nama_sublayanan }}
                                    </option>
                                @empty
                                    <option value="" disabled>Tidak ada data sub layanan</option>
                                @endforelse
                            </select>
                            @error('id_sublayanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            {{-- Debug info --}}
                            <small class="text-muted">Total: {{ $sublayanan->count() }} sub layanan</small>
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

    <!-- Modal Edit -->
    @foreach ($hama as $item)
        <div class="modal fade" id="modalEdit{{ $item->id_hama }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.hama.update', $item->id_hama) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Hama</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_hama_edit" class="form-label">Nama Hama <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_hama') is-invalid @enderror"
                                    id="nama_hama_edit" name="nama_hama"
                                    value="{{ old('nama_hama', $item->nama_hama) }}" required>
                                @error('nama_hama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="id_sublayanan_edit" class="form-label">Sub Layanan</label>
                                <select class="form-select @error('id_sublayanan') is-invalid @enderror"
                                    id="id_sublayanan_edit" name="id_sublayanan">
                                    <option value="">-- Pilih Sub Layanan --</option>
                                    @foreach ($sublayanan as $sub)
                                        <option value="{{ $sub->id_sublayanan }}"
                                            {{ old('id_sublayanan', $item->id_sublayanan) == $sub->id_sublayanan ? 'selected' : '' }}>
                                            {{ $sub->nama_sublayanan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_sublayanan')
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
    @endforeach

    <!-- Modal Hapus -->
    @foreach ($hama as $item)
        <div class="modal fade" id="modalHapus{{ $item->id_hama }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.hama.destroy', $item->id_hama) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Hama</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus hama <strong>{{ $item->nama_hama }}</strong>?</p>
                            @if ($item->sublayanan)
                                <p class="mb-0">Sub Layanan: <strong>{{ $item->sublayanan->nama_sublayanan }}</strong>
                                </p>
                            @endif
                            <div class="alert alert-warning mt-3">
                                <i class="fas fa-exclamation-triangle"></i>
                                Data yang sudah dihapus tidak dapat dikembalikan!
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tableHama').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                "order": [
                    [1, "desc"]
                ]
            });

            // Auto hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
@endpush
