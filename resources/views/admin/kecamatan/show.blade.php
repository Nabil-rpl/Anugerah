@extends('layouts.admin')

@section('title', 'Detail Kecamatan')
@section('page-title', 'Detail Kecamatan')
@section('page-subtitle', 'Informasi detail kecamatan')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Detail Kecamatan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="200" class="fw-bold">Kode Kecamatan</td>
                                <td width="20">:</td>
                                <td><span class="badge bg-primary">{{ $kecamatan->kode_kecamatan }}</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Kode Kota</td>
                                <td>:</td>
                                <td><span class="badge bg-info">{{ $kecamatan->kode_kota }}</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Nama Kecamatan</td>
                                <td>:</td>
                                <td>{{ $kecamatan->nama_kecamatan }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.kecamatan.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <div>
                            <a href="{{ route('admin.kecamatan.edit', $kecamatan->kode_kecamatan) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <button class="btn btn-danger" onclick="confirmDelete('{{ $kecamatan->kode_kecamatan }}')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                            <form id="delete-form-{{ $kecamatan->kode_kecamatan }}" 
                                  action="{{ route('admin.kecamatan.destroy', $kecamatan->kode_kecamatan) }}" 
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
        if (confirm('Apakah Anda yakin ingin menghapus kecamatan ini?')) {
            document.getElementById('delete-form-' + kode).submit();
        }
    }
</script>
@endsection