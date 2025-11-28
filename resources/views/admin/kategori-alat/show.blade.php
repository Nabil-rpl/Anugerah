@extends('layouts.admin')

@section('title', 'Detail Kategori Alat')
@section('page-title', 'Detail Kategori Alat')
@section('page-subtitle', 'Informasi detail kategori alat')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Detail Kategori</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="200" class="fw-bold">Kode Kategori</td>
                                <td width="20">:</td>
                                <td>{{ $kategoriAlat->kodekategori }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Nama Kategori</td>
                                <td>:</td>
                                <td>{{ $kategoriAlat->namakategori }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold align-top">Keterangan</td>
                                <td class="align-top">:</td>
                                <td>{{ $kategoriAlat->keterangan ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.kategori-alat.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <div>
                            <a href="{{ route('admin.kategori-alat.edit', $kategoriAlat->kodekategori) }}" 
                               class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <button class="btn btn-danger" onclick="confirmDelete({{ $kategoriAlat->kodekategori }})">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                            <form id="delete-form-{{ $kategoriAlat->kodekategori }}" 
                                  action="{{ route('admin.kategori-alat.destroy', $kategoriAlat->kodekategori) }}" 
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
        if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection