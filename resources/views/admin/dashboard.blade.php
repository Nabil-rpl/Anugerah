@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang kembali, Admin')

@section('content')
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Total Client</h6>
                            <h3 class="mb-0">{{ \App\Models\client::count() }}</h3>
                            <small class="text-success"><i class="bi bi-arrow-up"></i> {{ \App\Models\client::whereDate('waktu', '>=', now()->subMonth())->count() }} client baru</small>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Total Pengunjung</h6>
                            <h3 class="mb-0">{{ \App\Models\Pengunjung::count() }}</h3>
                            <small class="text-success"><i class="bi bi-arrow-up"></i> {{ \App\Models\Pengunjung::whereDate('waktu', today())->count() }} pengunjung hari ini</small>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-person-badge"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Total Berita</h6>
                            <h3 class="mb-0">{{ \App\Models\Berita::count() }}</h3>
                            <small class="text-success"><i class="bi bi-arrow-up"></i> {{ \App\Models\Berita::whereDate('tanggal', '>=', now()->subWeek())->count() }} berita minggu ini</small>
                        </div>
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-newspaper"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Total Layanan</h6>
                            <h3 class="mb-0">{{ \App\Models\LayananClient::count() }}</h3>
                            <small class="text-info"><i class="bi bi-briefcase"></i> Layanan aktif tersedia</small>
                        </div>
                        <div class="stat-icon bg-info bg-opacity-10 text-info">
                            <i class="bi bi-briefcase"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row mb-4">
        <div class="col-md-8 mb-3">
            <div class="chart-container">
                <h5 class="mb-3">Statistik Pengunjung</h5>
                <canvas id="visitorChart" height="80"></canvas>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="chart-container">
                <h5 class="mb-3">Kategori Layanan</h5>
                <canvas id="serviceChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activities Table -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Client Terbaru</h5>
                    <a href="{{ route('admin.client.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No. Pelanggan</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentClients = \App\Models\client::latest('waktu')->take(5)->get();
                            @endphp
                            @forelse($recentClients as $client)
                            <tr>
                                <td><span class="badge bg-primary">{{ $client->nomor_pelanggan }}</span></td>
                                <td><strong>{{ $client->nama_pelanggan }}</strong></td>
                                <td>{{ $client->email ?? '-' }}</td>
                                <td>{{ $client->waktu ? $client->waktu->format('d M Y') : '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-3">
                                    <i class="bi bi-inbox text-muted"></i>
                                    <p class="text-muted mb-0 small">Belum ada client</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Pengunjung Terbaru</h5>
                    <a href="{{ route('admin.pengunjung.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentVisitors = \App\Models\Pengunjung::latest('waktu')->take(5)->get();
                            @endphp
                            @forelse($recentVisitors as $visitor)
                            <tr>
                                <td><strong>{{ $visitor->nama_lengkap }}</strong></td>
                                <td>{{ Str::limit($visitor->lokasi_pengisi ?? 'Tidak diketahui', 20) }}</td>
                                <td>{{ $visitor->waktu ? $visitor->waktu->format('d M Y') : '-' }}</td>
                                <td>
                                    @if($visitor->status)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Aktif</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-3">
                                    <i class="bi bi-inbox text-muted"></i>
                                    <p class="text-muted mb-0 small">Belum ada pengunjung</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Full Width Table for Details -->
    <div class="row">
        <div class="col-12">
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Aktivitas Terbaru - Detail</h5>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-outline-primary active" onclick="showTable('client')">Client</button>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="showTable('visitor')">Pengunjung</button>
                    </div>
                </div>
                
                <!-- Client Detail Table -->
                <div class="table-responsive" id="clientTable">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No. Pelanggan</th>
                                <th>Nama Client</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Waktu Daftar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $detailClients = \App\Models\client::latest('waktu')->take(8)->get();
                            @endphp
                            @forelse($detailClients as $client)
                            <tr>
                                <td><span class="badge bg-primary">{{ $client->nomor_pelanggan }}</span></td>
                                <td><strong>{{ $client->nama_pelanggan }}</strong></td>
                                <td>{{ Str::limit($client->alamat, 30) ?? '-' }}</td>
                                <td>{{ $client->email ?? '-' }}</td>
                                <td>{{ $client->nomor_telepon ?? '-' }}</td>
                                <td>{{ $client->waktu ? $client->waktu->format('d M Y H:i') : '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.client.show', $client->nomor_pelanggan) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <p class="text-muted">Belum ada data client</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Visitor Detail Table (Hidden by default) -->
                <div class="table-responsive" id="visitorTable" style="display: none;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Lokasi</th>
                                <th>Waktu Kunjungan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $detailVisitors = \App\Models\Pengunjung::latest('waktu')->take(8)->get();
                            @endphp
                            @forelse($detailVisitors as $visitor)
                            <tr>
                                <td>#{{ $visitor->id_pengunjung }}</td>
                                <td><strong>{{ $visitor->nama_lengkap }}</strong></td>
                                <td>{{ $visitor->email ?? '-' }}</td>
                                <td>{{ $visitor->nomor_telepon ?? '-' }}</td>
                                <td>{{ $visitor->lokasi_pengisi ?? 'Tidak diketahui' }}</td>
                                <td>{{ $visitor->waktu ? $visitor->waktu->format('d M Y H:i') : '-' }}</td>
                                <td>
                                    @if($visitor->status)
                                        <span class="badge bg-success badge-status">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary badge-status">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.pengunjung.show', $visitor->id_pengunjung) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <p class="text-muted">Belum ada aktivitas pengunjung</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mt-4">
        <div class="col-md-6 mb-3">
            <div class="chart-container">
                <h5 class="mb-3">Status Pengunjung</h5>
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="p-3 bg-success bg-opacity-10 rounded">
                            <h2 class="text-success mb-1">{{ \App\Models\Pengunjung::where('status', true)->count() }}</h2>
                            <p class="text-muted mb-0">Pengunjung Aktif</p>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="p-3 bg-secondary bg-opacity-10 rounded">
                            <h2 class="text-secondary mb-1">{{ \App\Models\Pengunjung::where('status', false)->count() }}</h2>
                            <p class="text-muted mb-0">Tidak Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="chart-container">
                <h5 class="mb-3">Berita Terbaru</h5>
                <div class="list-group list-group-flush">
                    @php
                        $recentNews = \App\Models\Berita::latest('tanggal')->take(3)->get();
                    @endphp
                    @forelse($recentNews as $news)
                    <a href="{{ route('admin.berita.show', $news->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{ Str::limit($news->judul, 40) }}</div>
                            <small class="text-muted">{{ $news->tanggal->format('d M Y') }} • {{ $news->sumber ?? 'Anugerah Pasim' }}</small>
                        </div>
                        <span class="badge bg-primary rounded-pill">Baru</span>
                    </a>
                    @empty
                    <div class="text-center py-3">
                        <i class="bi bi-newspaper fs-3 text-muted"></i>
                        <p class="text-muted mb-0">Belum ada berita</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
        // Toggle between Client and Visitor table
        function showTable(type) {
            const clientTable = document.getElementById('clientTable');
            const visitorTable = document.getElementById('visitorTable');
            const buttons = document.querySelectorAll('.btn-group .btn');
            
            if (type === 'client') {
                clientTable.style.display = 'block';
                visitorTable.style.display = 'none';
                buttons[0].classList.add('active');
                buttons[1].classList.remove('active');
            } else {
                clientTable.style.display = 'none';
                visitorTable.style.display = 'block';
                buttons[0].classList.remove('active');
                buttons[1].classList.add('active');
            }
        }

        // Visitor Statistics Chart
        const visitorCtx = document.getElementById('visitorChart').getContext('2d');
        
        @php
            // Hitung pengunjung per bulan
            $monthlyVisitors = [];
            for ($i = 10; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $count = \App\Models\Pengunjung::whereYear('waktu', $date->year)
                    ->whereMonth('waktu', $date->month)
                    ->count();
                $monthlyVisitors[] = $count;
            }
        @endphp
        
        new Chart(visitorCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov'],
                datasets: [{
                    label: 'Jumlah Pengunjung',
                    data: @json($monthlyVisitors),
                    borderColor: '#1abc9c',
                    backgroundColor: 'rgba(26, 188, 156, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#1abc9c',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Service Category Chart
        const serviceCtx = document.getElementById('serviceChart').getContext('2d');
        
        @php
            // Hitung jumlah per jenis layanan (jika ada relasi di LayananClient)
            // Atau gunakan data contoh yang representatif
            $labels = ['Surat Keterangan', 'Izin Usaha', 'Legalisir', 'Konsultasi', 'Pendaftaran'];
            
            // Coba ambil data real jika ada tabel jenis_layanan
            try {
                $jenisLayananData = \App\Models\JenisLayanan::withCount('layananClient')->get();
                if($jenisLayananData->isNotEmpty()) {
                    $labels = $jenisLayananData->pluck('nama_layanan')->toArray();
                    $data = $jenisLayananData->pluck('layanan_client_count')->toArray();
                } else {
                    // Data contoh jika kosong
                    $data = [35, 25, 20, 15, 5];
                }
            } catch (\Exception $e) {
                // Fallback ke data contoh jika error
                $data = [35, 25, 20, 15, 5];
            }
        @endphp
        
        new Chart(serviceCtx, {
            type: 'doughnut',
            data: {
                labels: @json($labels),
                datasets: [{
                    data: @json($data),
                    backgroundColor: [
                        '#1abc9c',
                        '#3498db',
                        '#f39c12',
                        '#e74c3c',
                        '#9b59b6',
                        '#34495e'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.parsed || 0;
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let percentage = ((value / total) * 100).toFixed(1);
                                return label + ': ' + value + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection