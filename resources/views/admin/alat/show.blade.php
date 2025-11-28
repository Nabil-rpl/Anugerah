@extends('layouts.admin')

@section('title', 'Detail Alat')
@section('page-title', 'Detail Alat')
@section('page-subtitle', 'Informasi detail alat')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Detail Alat</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="200" class="fw-bold">ID Alat</td>
                                <td width="20">:</td>
                                <td>{{ $alat->idalat }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Nama Alat</td>
                                <td>:</td>
                                <td>{{ $alat->namaalat }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Kategori</td>
                                <td>:</td>
                                <td>
                                    @if($alat->kategori)
                                        <span class="badge bg-info">{{ $alat->kategori->namakategori }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Kode Satuan</td>
                                <td>:</td>
                                <td>{{ $alat->kodesatuan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Jumlah</td>
                                <td>:</td>
                                <td>{{ $alat->jumlah ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold align-top">Keterangan</td>
                                <td class="align-top">:</td>
                                <td>{{ $alat->keterangan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Waktu</td>
                                <td>:</td>
                                <td>{{ $alat->waktu ? $alat->waktu->format('d M Y H:i:s') : '-' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.alat.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <div>
                            <a href="{{ route('admin.alat.edit', $alat->idalat) }}" 
                               class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <button class="btn btn-danger" onclick="confirmDelete({{ $alat->idalat }})">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                            <form id="delete-form-{{ $alat->idalat }}" 
                                  action="{{ route('admin.alat.destroy', $alat->idalat) }}" 
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
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus alat ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection