@extends('layouts.admin')

@section('title', 'Kelola Logo Client')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Kelola Logo Client</h4>
                    <a href="{{ route('admin.logo-client.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Logo Client
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($logos->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Logo</th>
                                        <th width="30%">Nama Perusahaan</th>
                                        <th width="25%">Waktu</th>
                                        <th width="20%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logos as $index => $logo)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if($logo->gambar_logo)
                                                    <img src="{{ asset('uploads/logo-client/' . $logo->gambar_logo) }}" 
                                                         alt="{{ $logo->nama_perusahaan }}" 
                                                         class="img-thumbnail"
                                                         style="max-width: 100px; height: auto;">
                                                @else
                                                    <span class="badge bg-secondary">Tidak ada logo</span>
                                                @endif
                                            </td>
                                            <td>{{ $logo->nama_perusahaan }}</td>
                                            <td>{{ $logo->waktu ? $logo->waktu->format('d M Y H:i') : '-' }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.logo-client.show', $logo->id) }}" 
                                                       class="btn btn-sm btn-info" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.logo-client.edit', $logo->id) }}" 
                                                       class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.logo-client.destroy', $logo->id) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Yakin ingin menghapus logo client ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle"></i> Belum ada data logo client. 
                            <a href="{{ route('admin.logo-client.create') }}">Tambah logo client pertama</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection