@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3">Detail Client</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.client.index') }}">Master Client</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user-tie"></i> Informasi Client</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th width="40%" class="text-muted">Nomor Pelanggan</th>
                                        <td>: <span class="badge bg-primary">{{ $client->nomor_pelanggan }}</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Nama Pelanggan</th>
                                        <td>: <strong>{{ $client->nama_pelanggan }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted align-top">Alamat</th>
                                        <td>: {{ $client->alamat ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Email</th>
                                        <td>: {{ $client->email ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Nomor Telepon</th>
                                        <td>: {{ $client->nomor_telepon ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th width="40%" class="text-muted">Kode Provinsi</th>
                                        <td>: {{ $client->kode_provinsi ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Kode Kota</th>
                                        <td>: {{ $client->kode_kota ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Kode Kecamatan</th>
                                        <td>: {{ $client->kode_kecamatan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Kode Kelurahan</th>
                                        <td>: {{ $client->kode_kelurahan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Waktu Dibuat</th>
                                        <td>: {{ $client->waktu->format('d F Y, H:i') }} WIB</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($client->kontak || $client->nomor_kontak)
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-address-book"></i> Informasi Kontak</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th width="20%" class="text-muted">Nama Kontak</th>
                                <td>: {{ $client->kontak ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Nomor Kontak</th>
                                <td>: {{ $client->nomor_kontak ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($client->catatan)
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-sticky-note"></i> Catatan</h5>
                </div>
                <div class="card-body">
                    <p class="mb-0" style="white-space: pre-line;">{{ $client->catatan }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="mt-3">
        <div class="d-flex gap-2">
            <a href="{{ route('admin.client.edit', $client->nomor_pelanggan) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('admin.client.destroy', $client->nomor_pelanggan) }}" 
                  method="POST" 
                  onsubmit="return confirm('Yakin ingin menghapus client {{ $client->nama_pelanggan }}?');"
                  class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
            <a href="{{ route('admin.client.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection