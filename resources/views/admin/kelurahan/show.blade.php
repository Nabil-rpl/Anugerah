@extends('layouts.admin')

@section('title', 'Detail Kelurahan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Detail Kelurahan</h3>
                    <a href="{{ route('admin.kelurahan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th width="40%">Kode Kelurahan</th>
                                        <td><span class="badge bg-primary">{{ $kelurahan->kode_kelurahan }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Kelurahan</th>
                                        <td>{{ $kelurahan->nama_kelurahan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Kecamatan</th>
                                        <td>{{ $kelurahan->kode_kecamatan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Kecamatan</th>
                                        <td>
                                            @if($kelurahan->kecamatan)
                                                <span class="badge bg-info">{{ $kelurahan->kecamatan->nama_kecamatan }}</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak ada</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="button" 
                            class="btn btn-warning" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalEdit">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" 
                            class="btn btn-danger" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalHapus">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.kelurahan.update', $kelurahan->kode_kelurahan) }}" method="POST">
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
                            value="{{ $kelurahan->kode_kelurahan }}"
                            readonly>
                        <small class="text-muted">Kode kelurahan tidak dapat diubah</small>
                    </div>
                    <div class="mb-3">
                        <label for="kode_kecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                        <select class="form-select @error('kode_kecamatan') is-invalid @enderror" 
                            id="kode_kecamatan" 
                            name="kode_kecamatan"
                            required>
                            <option value="">-- Pilih Kecamatan --</option>
                            @php
                                $kecamatan = DB::table('kecamatan')->orderBy('nama_kecamatan', 'asc')->get();
                            @endphp
                            @foreach($kecamatan as $kec)
                                <option value="{{ $kec->kode_kecamatan }}" 
                                    {{ old('kode_kecamatan', $kelurahan->kode_kecamatan) == $kec->kode_kecamatan ? 'selected' : '' }}>
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
                            value="{{ old('nama_kelurahan', $kelurahan->nama_kelurahan) }}"
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

<!-- Modal Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.kelurahan.destroy', $kelurahan->kode_kelurahan) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Kelurahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus kelurahan <strong>{{ $kelurahan->nama_kelurahan }}</strong>?</p>
                    <div class="alert alert-info">
                        <strong>Kode:</strong> {{ $kelurahan->kode_kelurahan }}<br>
                        @if($kelurahan->kecamatan)
                            <strong>Kecamatan:</strong> {{ $kelurahan->kecamatan->nama_kecamatan }}
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
@endsection