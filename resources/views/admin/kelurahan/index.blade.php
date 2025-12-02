@extends('layouts.admin')

@section('title', 'Manajemen Kelurahan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Data Kelurahan</h3>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="fas fa-plus"></i> Tambah Kelurahan
                    </button>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tableKelurahan">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Kode Kelurahan</th>
                                    <th>Nama Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kelurahan as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->kode_kelurahan }}</td>
                                    <td>{{ $item->nama_kelurahan }}</td>
                                    <td>
                                        @if($item->kecamatan)
                                            <span class="badge bg-info">{{ $item->kecamatan->nama_kecamatan }}</span>
                                        @else
                                            <span class="badge bg-secondary">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.kelurahan.show', $item->kode_kelurahan) }}" 
                                            class="btn btn-sm btn-info" 
                                            title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-warning" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEdit{{ $item->kode_kelurahan }}"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalHapus{{ $item->kode_kelurahan }}"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data kelurahan</td>
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
            <form action="{{ route('admin.kelurahan.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kelurahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_kelurahan" class="form-label">Kode Kelurahan <span class="text-danger">*</span></label>
                        <input type="text" 
                            class="form-control @error('kode_kelurahan') is-invalid @enderror" 
                            id="kode_kelurahan" 
                            name="kode_kelurahan" 
                            value="{{ old('kode_kelurahan') }}"
                            placeholder="Contoh: 3273101001"
                            maxlength="10"
                            required>
                        @error('kode_kelurahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format: 10 digit kode wilayah</small>
                    </div>
                    <div class="mb-3">
                        <label for="kode_kecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                        <select class="form-select @error('kode_kecamatan') is-invalid @enderror" 
                            id="kode_kecamatan" 
                            name="kode_kecamatan"
                            required>
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach($kecamatan as $kec)
                                <option value="{{ $kec->kode_kecamatan }}" {{ old('kode_kecamatan') == $kec->kode_kecamatan ? 'selected' : '' }}>
                                    {{ $kec->nama_kecamatan }}
                                </option>
                            @endforeach
                        </select>
                        @error('kode_kecamatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_kelurahan" class="form-label">Nama Kelurahan <span class="text-danger">*</span></label>
                        <input type="text" 
                            class="form-control @error('nama_kelurahan') is-invalid @enderror" 
                            id="nama_kelurahan" 
                            name="nama_kelurahan" 
                            value="{{ old('nama_kelurahan') }}"
                            placeholder="Contoh: Cibabat"
                            required>
                        @error('nama_kelurahan')
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

<!-- Modal Edit -->
@foreach($kelurahan as $item)
<div class="modal fade" id="modalEdit{{ $item->kode_kelurahan }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.kelurahan.update', $item->kode_kelurahan) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kelurahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_kelurahan_view" class="form-label">Kode Kelurahan</label>
                        <input type="text" 
                            class="form-control" 
                            id="kode_kelurahan_view" 
                            value="{{ $item->kode_kelurahan }}"
                            readonly>
                        <small class="text-muted">Kode kelurahan tidak dapat diubah</small>
                    </div>
                    <div class="mb-3">
                        <label for="kode_kecamatan_edit" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                        <select class="form-select @error('kode_kecamatan') is-invalid @enderror" 
                            id="kode_kecamatan_edit" 
                            name="kode_kecamatan"
                            required>
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach($kecamatan as $kec)
                                <option value="{{ $kec->kode_kecamatan }}" 
                                    {{ old('kode_kecamatan', $item->kode_kecamatan) == $kec->kode_kecamatan ? 'selected' : '' }}>
                                    {{ $kec->nama_kecamatan }}
                                </option>
                            @endforeach
                        </select>
                        @error('kode_kecamatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_kelurahan_edit" class="form-label">Nama Kelurahan <span class="text-danger">*</span></label>
                        <input type="text" 
                            class="form-control @error('nama_kelurahan') is-invalid @enderror" 
                            id="nama_kelurahan_edit" 
                            name="nama_kelurahan" 
                            value="{{ old('nama_kelurahan', $item->nama_kelurahan) }}"
                            required>
                        @error('nama_kelurahan')
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
@foreach($kelurahan as $item)
<div class="modal fade" id="modalHapus{{ $item->kode_kelurahan }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.kelurahan.destroy', $item->kode_kelurahan) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Kelurahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus kelurahan <strong>{{ $item->nama_kelurahan }}</strong>?</p>
                    <div class="alert alert-info">
                        <strong>Kode:</strong> {{ $item->kode_kelurahan }}<br>
                        @if($item->kecamatan)
                            <strong>Kecamatan:</strong> {{ $item->kecamatan->nama_kecamatan }}
                        @endif
                    </div>
                    <div class="alert alert-warning">
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
        $('#tableKelurahan').DataTable({
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