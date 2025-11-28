@extends('layouts.admin')

@section('title', 'Detail Logo Client')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detail Logo Client</h4>
                    <div>
                        <a href="{{ route('admin.logo-client.edit', $logoClient->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.logo-client.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th width="30%">ID</th>
                                        <td>: {{ $logoClient->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Perusahaan</th>
                                        <td>: {{ $logoClient->nama_perusahaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Waktu Dibuat</th>
                                        <td>: {{ $logoClient->waktu ? $logoClient->waktu->format('d M Y H:i:s') : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama File</th>
                                        <td>: {{ $logoClient->gambar_logo ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5>Logo Perusahaan</h5>
                                @if($logoClient->gambar_logo)
                                    <div class="border p-3 rounded text-center bg-light">
                                        <img src="{{ asset('uploads/logo-client/' . $logoClient->gambar_logo) }}" 
                                             alt="{{ $logoClient->nama_perusahaan }}" 
                                             class="img-fluid"
                                             style="max-width: 400px;">
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle"></i> Tidak ada logo
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('admin.logo-client.edit', $logoClient->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Logo Client
                        </a>
                        <form action="{{ route('admin.logo-client.destroy', $logoClient->id) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus logo client ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Hapus Logo Client
                            </button>
                        </form>
                        <a href="{{ route('admin.logo-client.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection