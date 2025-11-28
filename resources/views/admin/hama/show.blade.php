@extends('layouts.admin')

@section('title', 'Detail Hama')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Detail Hama</h3>
                    <a href="{{ route('admin.hama.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th width="40%">ID Hama</th>
                                        <td>{{ $hama->id_hama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Hama</th>
                                        <td>{{ $hama->nama_hama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sub Layanan</th>
                                        <td>
                                            @if($hama->sublayanan)
                                                <span class="badge bg-info">{{ $hama->sublayanan->nama_sublayanan }}</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak ada</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($hama->sublayanan)
                                    <tr>
                                        <th>ID Sub Layanan</th>
                                        <td>{{ $hama->id_sublayanan }}</td>
                                    </tr>
                                    @endif
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
            <form action="{{ route('admin.hama.update', $hama->id_hama) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Hama</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_hama" class="form-label">Nama Hama <span class="text-danger">*</span></label>
                        <input type="text" 
                            class="form-control @error('nama_hama') is-invalid @enderror" 
                            id="nama_hama" 
                            name="nama_hama" 
                            value="{{ old('nama_hama', $hama->nama_hama) }}"
                            required>
                        @error('nama_hama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="id_sublayanan" class="form-label">Sub Layanan</label>
                        <select class="form-select @error('id_sublayanan') is-invalid @enderror" 
                            id="id_sublayanan" 
                            name="id_sublayanan">
                            <option value="">-- Pilih Sub Layanan --</option>
                            @php
                                $sublayanan = DB::table('app_sublayanan')->orderBy('nama_sublayanan', 'asc')->get();
                            @endphp
                            @foreach($sublayanan as $sub)
                                <option value="{{ $sub->id_sublayanan }}" 
                                    {{ old('id_sublayanan', $hama->id_sublayanan) == $sub->id_sublayanan ? 'selected' : '' }}>
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

<!-- Modal Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.hama.destroy', $hama->id_hama) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Hama</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus hama <strong>{{ $hama->nama_hama }}</strong>?</p>
                    @if($hama->sublayanan)
                        <p class="mb-0">Sub Layanan: <strong>{{ $hama->sublayanan->nama_sublayanan }}</strong></p>
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
@endsection