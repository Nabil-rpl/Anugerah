<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Anugerah Pasim</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --sidebar-width: 250px;
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --hover-color: #1abc9c;
            --text-light: #ecf0f1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ecf0f1;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            z-index: 1000;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        /* Logo Area */
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
        }

        .sidebar-logo {
            width: 60px;
            height: 60px;
            background: var(--hover-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 28px;
            color: white;
        }

        .sidebar-title {
            color: white;
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            white-space: nowrap;
        }

        /* User Profile */
        .user-profile {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--hover-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            color: white;
            font-size: 20px;
        }

        .user-name {
            color: white;
            font-size: 14px;
            font-weight: 600;
            margin: 0;
        }

        .user-role {
            color: var(--text-light);
            font-size: 12px;
            opacity: 0.8;
        }

        /* Navigation Menu */
        .sidebar-nav {
            padding: 15px 0;
        }

        .nav-section-title {
            color: rgba(255, 255, 255, 0.5);
            font-size: 11px;
            text-transform: uppercase;
            padding: 15px 20px 5px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .nav-item {
            margin: 3px 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: var(--text-light);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .nav-link.active {
            background: var(--hover-color);
            color: white;
            box-shadow: 0 3px 10px rgba(26, 188, 156, 0.3);
        }

        .nav-link i {
            font-size: 18px;
            min-width: 25px;
            text-align: center;
            margin-right: 12px;
        }

        .nav-text {
            font-size: 14px;
            white-space: nowrap;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        /* Top Bar */
        .topbar {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .page-title {
            margin: 0;
            font-size: 24px;
            color: #2c3e50;
            font-weight: 600;
        }

        .page-subtitle {
            color: #7f8c8d;
            font-size: 14px;
            margin: 0;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification-icon {
            position: relative;
            font-size: 20px;
            color: #7f8c8d;
            cursor: pointer;
            transition: color 0.3s;
        }

        .notification-icon:hover {
            color: var(--hover-color);
        }

        .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #e74c3c;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            background: #f8f9fa;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .user-dropdown:hover {
            background: #e9ecef;
        }

        .user-dropdown-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--hover-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }

        /* Content Area */
        .content-area {
            padding: 30px;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #ecf0f1;
            padding: 20px;
            font-weight: 600;
            color: #2c3e50;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.mobile-show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block !important;
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 1001;
                background: var(--primary-color);
                border: none;
                color: white;
                width: 40px;
                height: 40px;
                border-radius: 8px;
                font-size: 18px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            }

            .mobile-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .mobile-overlay.active {
                display: block;
            }
        }

        .mobile-toggle {
            display: none;
        }

        @yield('styles')
    </style>
</head>

<body>
    <!-- Mobile Toggle Button -->
    <button class="mobile-toggle" onclick="toggleMobileSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay" onclick="toggleMobileSidebar()"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-building"></i>
            </div>
            <h5 class="sidebar-title">Anugerah Pasim</h5>
        </div>

        <div class="user-profile">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <p class="user-name">{{ Auth::user()->name }}</p>
            <p class="user-role">Administrator</p>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-title">GENERAL</div>

            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Beranda</span>
                </a>
            </div>

            <div class="nav-section-title">MASTER DATA</div>

            <div class="nav-item">
                <a href="{{ route('admin.users.index') }}"
                    class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">Users</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.pengunjung.index') }}"
                    class="nav-link {{ request()->routeIs('admin.pengunjung.*') ? 'active' : '' }}">
                    <i class="fas fa-user-check"></i>
                    <span class="nav-text">Pengunjung</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.client.index') }}"
                    class="nav-link {{ request()->routeIs('admin.client.*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie"></i>
                    <span class="nav-text">Master Client</span>
                </a>
            </div>

            <div class="nav-section-title">CONTENT</div>

            <div class="nav-item">
                <a href="{{ route('admin.berita.index') }}"
                    class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i>
                    <span class="nav-text">Berita</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.slider.index') }}"
                    class="nav-link {{ request()->routeIs('admin.slider.*') ? 'active' : '' }}">
                    <i class="fas fa-images"></i>
                    <span class="nav-text">Slider</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.logo-client.index') }}"
                    class="nav-link {{ request()->routeIs('admin.logo-client.*') ? 'active' : '' }}">
                    <i class="fas fa-image"></i>
                    <span class="nav-text">Logo Client</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.layanan-client.index') }}"
                    class="nav-link {{ request()->routeIs('admin.layanan-client.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>
                    <span class="nav-text">Layanan Client</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.jenis-layanan.index') }}"
                    class="nav-link {{ request()->routeIs('admin.jenis-layanan.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>
                    <span class="nav-text">Jenis Layanan</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.kategori-alat.index') }}"
                    class="nav-link {{ request()->routeIs('admin.kategori_alat.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>
                    <span class="nav-text">Kategori Alat</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.alat.index') }}"
                    class="nav-link {{ request()->routeIs('admin.alat.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>
                    <span class="nav-text">Alat</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.satuan.index') }}"
                    class="nav-link {{ request()->routeIs('admin.satuan.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>
                    <span class="nav-text">Satuan</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.hama.index') }}"
                    class="nav-link {{ request()->routeIs('admin.hama.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>
                    <span class="nav-text">Hama</span>
                </a>
            </div>

            <div class="nav-section-title">SYSTEM</div>

            <div class="nav-item">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="topbar">
            <div>
                <h4 class="page-title">@yield('page-title', 'Dashboard')</h4>
                <p class="page-subtitle">@yield('page-subtitle', 'Selamat datang kembali')</p>
            </div>
            <div class="topbar-actions">
                <div class="notification-icon">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </div>
                <div class="dropdown">
                    <div class="user-dropdown" data-bs-toggle="dropdown">
                        <div class="user-dropdown-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form-top').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <!-- Logout Forms -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <form id="logout-form-top" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Mobile sidebar toggle
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobileOverlay');

            sidebar.classList.toggle('mobile-show');
            overlay.classList.toggle('active');
        }

        // Close sidebar when clicking on a link in mobile
        if (window.innerWidth <= 768) {
            document.querySelectorAll('.sidebar .nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    toggleMobileSidebar();
                });
            });
        }
    </script>

    @yield('scripts')
</body>

</html>
