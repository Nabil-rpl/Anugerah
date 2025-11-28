<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Pengunjung - Laravel 12</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1a237e 0%, #283593 100%);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
        }

        .brand-logo {
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .topbar {
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
        }

        .form-container {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0 sidebar">
                <div class="brand-logo">
                    <i class="bi bi-speedometer2"></i> AdminPanel
                </div>
                <nav class="nav flex-column mt-4">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        <i class="bi bi-people"></i> Users
                    </a>
                    <a class="nav-link active" href="{{ route('admin.pengunjung.index') }}">
                        <i class="bi bi-person-badge"></i> Pengunjung
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-cart"></i> Orders
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-bar-chart"></i> Analytics
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-gear"></i> Settings
                    </a>
                    <hr class="text-white mx-3">
                    <a class="nav-link" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-0 main-content">
                <!-- Top Bar -->
                <div class="topbar d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">Edit Pengunjung</h4>
                        <small class="text-muted">Edit data pengunjung</small>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="position-relative">
                            <i class="bi bi-bell fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> Admin
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="p-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-container">
                                <form action="{{ route('admin.pengunjung.update', $pengunjung->id_pengunjung) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row">
                                        <!-- Nama Lengkap -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                                   name="nama_lengkap" value="{{ old('nama_lengkap', $pengunjung->nama_lengkap) }}" required>
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   name="email" value="{{ old('email', $pengunjung->email) }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Nomor Telepon -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nomor Telepon</label>
                                            <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" 
                                                   name="nomor_telepon" value="{{ old('nomor_telepon', $pengunjung->nomor_telepon) }}">
                                            @error('nomor_telepon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Lokasi Pengisi -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Lokasi Pengisi</label>
                                            <input type="text" class="form-control @error('lokasi_pengisi') is-invalid @enderror" 
                                                   name="lokasi_pengisi" value="{{ old('lokasi_pengisi', $pengunjung->lokasi_pengisi) }}">
                                            @error('lokasi_pengisi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Alamat Lengkap -->
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Alamat Lengkap</label>
                                            <textarea class="form-control @error('alamat_lengkap') is-invalid @enderror" 
                                                      name="alamat_lengkap" rows="3">{{ old('alamat_lengkap', $pengunjung->alamat_lengkap) }}</textarea>
                                            @error('alamat_lengkap')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Kode Provinsi -->
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Kode Provinsi</label>
                                            <input type="text" class="form-control @error('kode_provinsi') is-invalid @enderror" 
                                                   name="kode_provinsi" value="{{ old('kode_provinsi', $pengunjung->kode_provinsi) }}" maxlength="2">
                                            @error('kode_provinsi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Kode Kota -->
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Kode Kota</label>
                                            <input type="text" class="form-control @error('kode_kota') is-invalid @enderror" 
                                                   name="kode_kota" value="{{ old('kode_kota', $pengunjung->kode_kota) }}" maxlength="4">
                                            @error('kode_kota')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Kode Kecamatan -->
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Kode Kecamatan</label>
                                            <input type="text" class="form-control @error('kode_kecamatan') is-invalid @enderror" 
                                                   name="kode_kecamatan" value="{{ old('kode_kecamatan', $pengunjung->kode_kecamatan) }}" maxlength="7">
                                            @error('kode_kecamatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Kode Kelurahan -->
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Kode Kelurahan</label>
                                            <input type="text" class="form-control @error('kode_kelurahan') is-invalid @enderror" 
                                                   name="kode_kelurahan" value="{{ old('kode_kelurahan', $pengunjung->kode_kelurahan) }}" maxlength="10">
                                            @error('kode_kelurahan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Pesan -->
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Pesan</label>
                                            <textarea class="form-control @error('pesan') is-invalid @enderror" 
                                                      name="pesan" rows="3">{{ old('pesan', $pengunjung->pesan) }}</textarea>
                                            @error('pesan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-12 mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="status" value="1" 
                                                       id="status" {{ old('status', $pengunjung->status) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status">
                                                    Status Aktif
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('admin.pengunjung.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save"></i> Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>