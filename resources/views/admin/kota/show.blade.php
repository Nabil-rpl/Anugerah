@extends('layouts.admin')

@section('title', 'Detail Kota')
@section('page-title', 'Detail Kota')
@section('page-subtitle', 'Informasi detail kota/kabupaten')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Detail Kota</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="200" class="fw-bold">Kode Kota</td>
                                <td width="20">:</td>
                                <td><span class="badge bg-primary">{{ $kota->kode_kota }}</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Provinsi</td>
                                <td>:</td>
                                <td>
                                    @if($kota->provinsi)
                                        <span class="badge bg-info">{{ $kota->provinsi->nama_provinsi }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $kota->kode_provinsi }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Nama Kota</td>
                                <td>:</td>
                                <td>{{ $kota->nama_kota }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Jumlah Kecamatan</td>
                                <td>:</td>
                                <td>
                                    <span class="badge bg-success">{{ $kota->kecamatans->count() }} Kecamatan</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Daftar Kecamatan -->
                    @if($kota->kecamatans->count() > 0)
                        <hr class="my-4">
                        <h6 class="mb-3"><i class="bi bi-list-ul"></i> Daftar Kecamatan</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Kode Kecamatan</th>
                                        <th>Nama Kecamatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kota->kecamatans as $index => $kecamatan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><span class="badge bg-secondary">{{ $kecamatan->kode_kecamatan }}</span></td>
                                            <td>{{ $kecamatan->nama_kecamatan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning mt-3">
                            <i class="bi bi-exclamation-triangle"></i> Belum ada kecamatan terdaftar di kota ini.
                        </div>
                    @endif

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.kota.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <div>
                            <a href="{{ route('admin.kota.edit', $kota->kode_kota) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <button class="btn btn-danger" onclick="confirmDelete('{{ $kota->kode_kota }}')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                            <form id="delete-form-{{ $kota->kode_kota }}" 
                                  action="{{ route('admin.kota.destroy', $kota->kode_kota) }}" 
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
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
        if (confirm('Apakah Anda yakin ingin menghapus kota ini?')) {
            document.getElementById('delete-form-' + kode).submit();
        }
    }
</script>
@endsection