@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3">Edit Client</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.client.index') }}">Master Client</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.client.update', $client->nomor_pelanggan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nomor_pelanggan" class="form-label">Nomor Pelanggan</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="nomor_pelanggan" 
                                   value="{{ $client->nomor_pelanggan }}" 
                                   readonly
                                   disabled>
                            <small class="text-muted">Nomor pelanggan tidak dapat diubah</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('nama_pelanggan') is-invalid @enderror" 
                                   id="nama_pelanggan" 
                                   name="nama_pelanggan" 
                                   value="{{ old('nama_pelanggan', $client->nama_pelanggan) }}" 
                                   required
                                   maxlength="50"
                                   placeholder="Masukkan nama pelanggan">
                            @error('nama_pelanggan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                              id="alamat" 
                              name="alamat" 
                              rows="3"
                              placeholder="Masukkan alamat lengkap">{{ old('alamat', $client->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="kode_provinsi" class="form-label">Kode Provinsi</label>
                            <input type="text" 
                                   class="form-control @error('kode_provinsi') is-invalid @enderror" 
                                   id="kode_provinsi" 
                                   name="kode_provinsi" 
                                   value="{{ old('kode_provinsi', $client->kode_provinsi) }}" 
                                   maxlength="2"
                                   placeholder="Cth: 32">
                            @error('kode_provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="kode_kota" class="form-label">Kode Kota</label>
                            <input type="text" 
                                   class="form-control @error('kode_kota') is-invalid @enderror" 
                                   id="kode_kota" 
                                   name="kode_kota" 
                                   value="{{ old('kode_kota', $client->kode_kota) }}" 
                                   maxlength="4"
                                   placeholder="Cth: 3204">
                            @error('kode_kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="kode_kecamatan" class="form-label">Kode Kecamatan</label>
                            <input type="text" 
                                   class="form-control @error('kode_kecamatan') is-invalid @enderror" 
                                   id="kode_kecamatan" 
                                   name="kode_kecamatan" 
                                   value="{{ old('kode_kecamatan', $client->kode_kecamatan) }}" 
                                   maxlength="7"
                                   placeholder="Cth: 3204010">
                            @error('kode_kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="kode_kelurahan" class="form-label">Kode Kelurahan</label>
                            <input type="text" 
                                   class="form-control @error('kode_kelurahan') is-invalid @enderror" 
                                   id="kode_kelurahan" 
                                   name="kode_kelurahan" 
                                   value="{{ old('kode_kelurahan', $client->kode_kelurahan) }}" 
                                   maxlength="10"
                                   placeholder="Cth: 3204010001">
                            @error('kode_kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $client->email) }}" 
                                   maxlength="50"
                                   placeholder="example@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" 
                                   class="form-control @error('nomor_telepon') is-invalid @enderror" 
                                   id="nomor_telepon" 
                                   name="nomor_telepon" 
                                   value="{{ old('nomor_telepon', $client->nomor_telepon) }}" 
                                   maxlength="20"
                                   placeholder="08xxxxxxxxxx">
                            @error('nomor_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Nama Kontak</label>
                            <input type="text" 
                                   class="form-control @error('kontak') is-invalid @enderror" 
                                   id="kontak" 
                                   name="kontak" 
                                   value="{{ old('kontak', $client->kontak) }}" 
                                   maxlength="50"
                                   placeholder="Nama contact person">
                            @error('kontak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nomor_kontak" class="form-label">Nomor Kontak</label>
                            <input type="number" 
                                   class="form-control @error('nomor_kontak') is-invalid @enderror" 
                                   id="nomor_kontak" 
                                   name="nomor_kontak" 
                                   value="{{ old('nomor_kontak', $client->nomor_kontak) }}" 
                                   min="0"
                                   max="2147483647"
                                   placeholder="Maksimal 10 digit"
                                   oninput="if(this.value.length > 10) this.value = this.value.slice(0,10);">
                            <small class="text-muted">Maksimal 10 digit angka</small>
                            @error('nomor_kontak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea class="form-control @error('catatan') is-invalid @enderror" 
                              id="catatan" 
                              name="catatan" 
                              rows="3"
                              placeholder="Catatan tambahan (opsional)">{{ old('catatan', $client->catatan) }}</textarea>
                    @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.client.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection