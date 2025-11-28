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
                            <h6 class="text-muted mb-2">Total Users</h6>
                            <h3 class="mb-0">{{ \App\Models\User::count() }}</h3>
                            <small class="text-success"><i class="bi bi-arrow-up"></i> 12% dari bulan lalu</small>
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
                            <small class="text-success"><i class="bi bi-arrow-up"></i> 15 pengunjung baru</small>
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
                            <small class="text-success"><i class="bi bi-arrow-up"></i> 5 berita baru</small>
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
                            <h6 class="text-muted mb-2">Revenue</h6>
                            <h3 class="mb-0">Rp 45.2M</h3>
                            <small class="text-danger"><i class="bi bi-arrow-down"></i> 3% dari bulan lalu</small>
                        </div>
                        <div class="stat-icon bg-info bg-opacity-10 text-info">
                            <i class="bi bi-currency-dollar"></i>
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
                <h5 class="mb-3">Sales Overview</h5>
                <canvas id="salesChart" height="80"></canvas>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="chart-container">
                <h5 class="mb-3">Traffic Sources</h5>
                <canvas id="trafficChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="row">
        <div class="col-12">
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Recent Orders</h5>
                    <a href="#" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#ORD-001</td>
                                <td>John Doe</td>
                                <td>Laptop ASUS ROG</td>
                                <td>17 Nov 2025</td>
                                <td>Rp 15.000.000</td>
                                <td><span class="badge bg-success badge-status">Completed</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#ORD-002</td>
                                <td>Jane Smith</td>
                                <td>iPhone 15 Pro</td>
                                <td>17 Nov 2025</td>
                                <td>Rp 18.500.000</td>
                                <td><span class="badge bg-warning badge-status">Processing</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#ORD-003</td>
                                <td>Robert Brown</td>
                                <td>Samsung Galaxy S24</td>
                                <td>16 Nov 2025</td>
                                <td>Rp 12.000.000</td>
                                <td><span class="badge bg-info badge-status">Shipped</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#ORD-004</td>
                                <td>Emily Davis</td>
                                <td>MacBook Pro M3</td>
                                <td>16 Nov 2025</td>
                                <td>Rp 28.000.000</td>
                                <td><span class="badge bg-danger badge-status">Cancelled</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#ORD-005</td>
                                <td>Michael Wilson</td>
                                <td>Sony WH-1000XM5</td>
                                <td>15 Nov 2025</td>
                                <td>Rp 4.500.000</td>
                                <td><span class="badge bg-success badge-status">Completed</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'],
                datasets: [{
                    label: 'Sales (Jutaan Rp)',
                    data: [30, 35, 33, 40, 38, 45, 42, 48, 46, 50, 45],
                    borderColor: '#1a237e',
                    backgroundColor: 'rgba(26, 35, 126, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Traffic Chart
        const trafficCtx = document.getElementById('trafficChart').getContext('2d');
        new Chart(trafficCtx, {
            type: 'doughnut',
            data: {
                labels: ['Direct', 'Social Media', 'Search Engine', 'Referral'],
                datasets: [{
                    data: [35, 25, 30, 10],
                    backgroundColor: [
                        '#1a237e',
                        '#2196F3',
                        '#4CAF50',
                        '#FFC107'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endsection