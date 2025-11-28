@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3">Detail Layanan Client</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.layanan-client.index') }}">Layanan Client</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    @if($layananClient->gambar)
                        <img src="{{ asset($layananClient->gambar) }}" 
                             alt="{{ $layananClient->judul }}" 
                             class="img-fluid rounded shadow-sm">
                    @else
                        <div class="text-center p-5 bg-light rounded">
                            <i class="fas fa-image fa-3x text-muted"></i>
                            <p class="text-muted mt-2 mb-0">Tidak ada gambar</p>
                        </div>
                    @endif
                </div>
                
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th width="30%" class="text-muted">Judul</th>
                                <td>: <strong>{{ $layananClient->judul }}</strong></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Tanggal</th>
                                <td>: {{ $layananClient->tanggal->format('d F Y, H:i') }} WIB</td>
                            </tr>
                            <tr>
                                <th class="text-muted align-top">Isi</th>
                                <td>: <div class="mt-1" style="text-align: justify;">{{ $layananClient->isi }}</div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex gap-2">
                <a href="{{ route('admin.layanan-client.edit', $layananClient) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.layanan-client.destroy', $layananClient) }}" 
                      method="POST" 
                      onsubmit="return confirm('Yakin ingin menghapus data ini?');"
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
                <a href="{{ route('admin.layanan-client.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection