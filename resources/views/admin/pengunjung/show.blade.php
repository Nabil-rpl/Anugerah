<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Pengunjung - Laravel 12</title>

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

        .detail-container {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .detail-row {
            padding: 15px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
        }

        .detail-value {
            color: #212529;
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
                        <h4 class="mb-0">Detail Pengunjung</h4>
                        <small class="text-muted">Informasi lengkap pengunjung</small>
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
                            <div class="detail-container">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="mb-0">
                                        <i class="bi bi-person-circle"></i> {{ $pengunjung->nama_lengkap }}
                                    </h5>
                                    <div>
                                        @if($pengunjung->status)
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle"></i> Aktif
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-x-circle"></i> Tidak Aktif
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-row">
                                            <div class="detail-label">
                                                <i class="bi bi-hash"></i> ID Pengunjung
                                            </div>
                                            <div class="detail-value">{{ $pengunjung->id_pengunjung }}</div>
                                        </div>

                                        <div class="detail-row">
                                            <div class="detail-label">
                                                <i class="bi bi-person"></i> Nama Lengkap
                                            </div>
                                            <div class="detail-value">{{ $pengunjung->nama_lengkap ?? '-' }}</div>
                                        </div>

                                        <div class="detail-row">
                                            <div class="detail-label">
                                                <i class="bi bi-envelope"></i> Email
                                            </div>
                                            <div class="detail-value">{{ $pengunjung->email ?? '-' }}</div>
                                        </div>

                                        <div class="detail-row">
                                            <div class="detail-label">
                                                <i class="bi bi-telephone"></i> Nomor Telepon
                                            </div>
                                            <div class="detail-value">{{ $pengunjung->nomor_telepon ?? '-' }}</div>
                                        </div>

                                        <div class="detail-row">
                                            <div class="detail-label">
                                                <i class="bi bi-geo-alt"></i> Lokasi Pengisi
                                            </div>
                                            <div class="detail-value">{{ $pengunjung->lokasi_pengisi ?? '-' }}</div>
                                        </div>

                                        <div class="detail-row">
                                            <div class="detail-label">
                                                <i class="bi bi-clock"></i> Waktu
                                            </div>
                                            <div class="detail-value">
                                                {{ $pengunjung->waktu ? $pengunjung->waktu->format('d M Y H:i:s') : '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="detail-row">
                                            <div class="detail-label">
                                                <i class="bi bi-map"></i> Alamat Lengkap
                                            </div>
                                            <div class="detail-value">{{ $pengunjung->alamat_lengkap ?? '-' }}</div>
                                        </div>

                                        <div class="detail-row">
                                            <div class="detail-label">
                                                <i class="bi bi-pin-map"></i> Kode Provinsi
                                            </div>
                                            <div class="detail-value">{{ $pengunjung->kode_provinsi ?? '-' }}</div>
                                        </div>

                                        <div class="detail-row">
                                            <div class="detail-label">
                                                <i class="bi bi-pin-map"></i> Kode Kota
                                            </div>
                                            <div class="detail-value">{{ $pengunjung->kode_kota ?? '-' }}</div>
                                        </div>

                                        <div class="detail-row">
                                            <div class="detail-label">
                                                <i class="bi bi-pin-map"></i> Kode Kecamatan
                                            </div>
                                            <div class="detail-value">{{ $pengunjung->kode_kecamatan ?? '-' }}</div>
                                        </div>

                                        <div class="detail-row">
                                            <div class="detail-label">
                                                <i class="bi bi-pin-map"></i> Kode Kelurahan
                                            </div>
                                            <div class="detail-value">{{ $pengunjung->kode_kelurahan ?? '-' }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="detail-row">
                                            <div class="detail-label">
                                                <i class="bi bi-chat-left-text"></i> Pesan
                                            </div>
                                            <div class="detail-value">{{ $pengunjung->pesan ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 justify-content-end mt-4">
                                    <a href="{{ route('admin.pengunjung.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left"></i> Kembali
                                    </a>
                                    <a href="{{ route('admin.pengunjung.edit', $pengunjung->id_pengunjung) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <button class="btn btn-danger" onclick="confirmDelete()">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                    <form id="delete-form" action="{{ route('admin.pengunjung.destroy', $pengunjung->id_pengunjung) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function confirmDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus data pengunjung ini?')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</body>

</html>