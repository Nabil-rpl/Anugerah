<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - Laravel 12</title>

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

        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .chart-container {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .table-container {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
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
                    <form action="{{ route('dashboard') }}" method="GET">
                        <button type="submit">Dashboard</button>
                    </form>
                    <a class="nav-link" href="#">
                        <i class="bi bi-people"></i> Users
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-box-seam"></i> Products
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
                        <h4 class="mb-0">Dashboard</h4>
                        <small class="text-muted">Selamat datang kembali, Admin</small>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="position-relative">
                            <i class="bi bi-bell fs-5"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3
                            </span>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> Admin
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a>
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right"></i>
                                        Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="p-4">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="text-muted mb-2">Total Users</h6>
                                            <h3 class="mb-0">1,234</h3>
                                            <small class="text-success"><i class="bi bi-arrow-up"></i> 12% dari bulan
                                                lalu</small>
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
                                            <h6 class="text-muted mb-2">Total Orders</h6>
                                            <h3 class="mb-0">567</h3>
                                            <small class="text-success"><i class="bi bi-arrow-up"></i> 8% dari bulan
                                                lalu</small>
                                        </div>
                                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-cart"></i>
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
                                            <small class="text-danger"><i class="bi bi-arrow-down"></i> 3% dari bulan
                                                lalu</small>
                                        </div>
                                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                            <i class="bi bi-currency-dollar"></i>
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
                                            <h6 class="text-muted mb-2">Products</h6>
                                            <h3 class="mb-0">89</h3>
                                            <small class="text-success"><i class="bi bi-arrow-up"></i> 5 produk
                                                baru</small>
                                        </div>
                                        <div class="stat-icon bg-info bg-opacity-10 text-info">
                                            <i class="bi bi-box-seam"></i>
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
                                                    <button class="btn btn-sm btn-outline-primary"><i
                                                            class="bi bi-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i
                                                            class="bi bi-pencil"></i></button>
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
                                                    <button class="btn btn-sm btn-outline-primary"><i
                                                            class="bi bi-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i
                                                            class="bi bi-pencil"></i></button>
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
                                                    <button class="btn btn-sm btn-outline-primary"><i
                                                            class="bi bi-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i
                                                            class="bi bi-pencil"></i></button>
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
                                                    <button class="btn btn-sm btn-outline-primary"><i
                                                            class="bi bi-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i
                                                            class="bi bi-pencil"></i></button>
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
                                                    <button class="btn btn-sm btn-outline-primary"><i
                                                            class="bi bi-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i
                                                            class="bi bi-pencil"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
</body>

</html>
