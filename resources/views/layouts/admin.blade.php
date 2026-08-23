<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard') | Riya Fashion — Surat</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --rf-navy: #0b1329;
            --rf-navy-dark: #070d1e;
            --rf-navy-light: #16203d;
            --rf-gold: #c59b27;
            --rf-gold-hover: #dfb743;
            --rf-gold-subtle: rgba(197, 155, 39, 0.12);
            --rf-bg: #f8fafc;
            --rf-sidebar-w: 260px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--rf-bg);
            color: #1e293b;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--rf-sidebar-w);
            background: linear-gradient(180deg, var(--rf-navy) 0%, var(--rf-navy-dark) 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 22px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            background: var(--rf-gold-subtle);
            border: 1px solid var(--rf-gold);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--rf-gold);
            font-size: 19px;
            flex-shrink: 0;
        }

        .brand-title {
            font-family: 'Cinzel', serif;
            font-size: 17px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 1px;
            line-height: 1.2;
        }

        .brand-sub {
            font-size: 11px;
            color: #94a3b8;
            letter-spacing: 0.3px;
        }

        .sidebar-menu {
            padding: 16px 12px;
            flex: 1;
            overflow-y: auto;
        }

        .menu-category {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #64748b;
            padding: 14px 14px 6px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            color: #cbd5e1;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
            margin-bottom: 3px;
        }

        .nav-link-custom i {
            font-size: 17px;
            color: #94a3b8;
            transition: color 0.2s ease;
        }

        .nav-link-custom:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.06);
        }

        .nav-link-custom:hover i {
            color: var(--rf-gold);
        }

        .nav-link-custom.active {
            color: #ffffff;
            background-color: var(--rf-gold-subtle);
            border-left: 3px solid var(--rf-gold);
            font-weight: 600;
        }

        .nav-link-custom.active i {
            color: var(--rf-gold);
        }

        .sidebar-footer {
            padding: 14px 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(0, 0, 0, 0.2);
        }

        /* Top Navbar */
        .top-navbar {
            position: fixed;
            top: 0;
            right: 0;
            left: var(--rf-sidebar-w);
            height: 68px;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            z-index: 1030;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            transition: left 0.3s ease;
        }

        /* Main Wrapper */
        .main-wrapper {
            margin-left: var(--rf-sidebar-w);
            padding-top: 68px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        .content-area {
            flex: 1;
            padding: 28px;
        }

        .admin-footer {
            padding: 18px 28px;
            border-top: 1px solid #e2e8f0;
            background: #ffffff;
            font-size: 13px;
            color: #64748b;
        }

        /* Card Styles */
        .stat-card {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(0,0,0,0.08);
        }

        .stat-icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        /* Gold Button */
        .btn-gold {
            background: linear-gradient(135deg, #c59b27 0%, #b38918 100%);
            border: none;
            color: #ffffff;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-gold:hover {
            background: linear-gradient(135deg, #dfb743 0%, #c59b27 100%);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-outline-gold {
            border: 1px solid var(--rf-gold);
            color: var(--rf-gold);
            background: transparent;
            font-weight: 600;
            border-radius: 8px;
        }

        .btn-outline-gold:hover {
            background: var(--rf-gold);
            color: #ffffff;
        }

        /* Mobile Layout */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .top-navbar {
                left: 0;
            }
            .main-wrapper {
                margin-left: 0;
            }
            .sidebar-backdrop {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(15, 23, 42, 0.65);
                backdrop-filter: blur(2px);
                z-index: 1035;
                display: none;
            }
            .sidebar-backdrop.show {
                display: block;
            }
        }
    </style>
</head>
<body>

    <!-- Mobile Backdrop -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- Sidebar Navigation -->
    <aside class="sidebar" id="adminSidebar">
        <!-- Brand Header -->
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <div class="brand-icon">
                <i class="bi bi-gem"></i>
            </div>
            <div class="brand-text">
                <span class="brand-title">RIYA FASHION</span>
                <span class="brand-sub">Admin Portal • Surat</span>
            </div>
        </a>

        <!-- Menu Links -->
        <div class="sidebar-menu">
            <!-- MAIN OVERVIEW -->
            <div class="menu-category">MAIN OVERVIEW</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <!-- BUSINESS PROFILE -->
            <div class="menu-category">BUSINESS PROFILE</div>
            <a href="{{ route('admin.business.index') }}" class="nav-link-custom {{ request()->routeIs('admin.business.*') ? 'active' : '' }}">
                <i class="bi bi-building-gear"></i>
                <span>Business Information</span>
            </a>

            <!-- SAREE WORK & CONTENT -->
            <div class="menu-category">SAREE WORK & CONTENT</div>
            <a href="{{ route('admin.services.index') }}" class="nav-link-custom {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="bi bi-scissors"></i>
                <span>Services</span>
            </a>
            <a href="{{ route('admin.processes.index') }}" class="nav-link-custom {{ request()->routeIs('admin.processes.*') ? 'active' : '' }}">
                <i class="bi bi-diagram-3"></i>
                <span>Work Process</span>
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="nav-link-custom {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                <i class="bi bi-images"></i>
                <span>Gallery</span>
            </a>

            <!-- MERCHANTS & ENQUIRIES -->
            <div class="menu-category">MERCHANTS & ENQUIRIES</div>
            <a href="{{ route('admin.reviews.index') }}" class="nav-link-custom {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                <i class="bi bi-star-fill text-warning"></i>
                <span>Client Reviews</span>
            </a>
            <a href="{{ route('admin.messages.index') }}" class="nav-link-custom {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                <i class="bi bi-chat-left-dots-fill"></i>
                <span>Contact Messages</span>
                @php
                    $unreadCount = \App\Models\ContactMessage::unread()->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="badge bg-danger rounded-pill ms-auto">{{ $unreadCount }}</span>
                @endif
            </a>
        </div>

        <!-- Sidebar Footer -->
        <div class="sidebar-footer">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; font-weight: 700; font-size: 13px;">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <div class="text-white text-truncate small fw-semibold">{{ Auth::user()->name ?? 'Administrator' }}</div>
                    <div class="text-muted text-truncate" style="font-size: 11px;">{{ Auth::user()->email ?? '' }}</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Top Navigation Bar -->
    <header class="top-navbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-light d-lg-none p-1 px-2 border" id="toggleSidebarBtn" aria-label="Toggle Sidebar">
                <i class="bi bi-list fs-5"></i>
            </button>
            <h5 class="mb-0 fw-bold text-dark d-none d-sm-block">
                @yield('page-header', 'Dashboard Overview')
            </h5>
        </div>

        <div class="d-flex align-items-center gap-3">
            <!-- View Live Website -->
            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-secondary btn-sm px-3 d-none d-md-inline-flex align-items-center gap-1">
                <i class="bi bi-box-arrow-up-right"></i>
                <span>View Live Site</span>
            </a>

            <!-- Admin Dropdown / Logout -->
            <div class="dropdown">
                <button class="btn btn-light btn-sm border dropdown-toggle d-flex align-items-center gap-2 px-3 py-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle text-primary"></i>
                    <span class="fw-semibold">{{ Auth::user()->name ?? 'Admin' }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2">
                    <li class="px-3 py-1">
                        <div class="small text-muted">Signed in as</div>
                        <div class="fw-semibold text-truncate" style="max-width: 180px;">{{ Auth::user()->email ?? '' }}</div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 small" href="{{ route('admin.business.index') }}">
                            <i class="bi bi-building-gear text-secondary"></i> Business Information
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 small" href="{{ url('/') }}" target="_blank">
                            <i class="bi bi-globe text-secondary"></i> View Website
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2 small">
                                <i class="bi bi-box-arrow-right"></i> Logout Securely
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-wrapper">
        <main class="content-area">
            <!-- Global Flash Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2 px-3 mb-4 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div class="small fw-medium">{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center py-2 px-3 mb-4 shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                    <div class="small fw-medium">{{ session('warning') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center py-2 px-3 mb-4 shadow-sm" role="alert">
                    <i class="bi bi-x-circle-fill me-2 fs-5"></i>
                    <div class="small fw-medium">{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-4 shadow-sm" role="alert">
                    <div class="fw-semibold small mb-1">Please correct the following errors:</div>
                    <ul class="mb-0 ps-3 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Dynamic View Content -->
            @yield('content')
        </main>

        <!-- Admin Footer -->
        <footer class="admin-footer d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2">
            <div>
                <strong>Riya Fashion</strong> — B2B Textile Saree Processing & Embellishments • Surat, Gujarat
            </div>
            <div class="text-muted">
                Admin Portal v1.0 • 10+ Years Industry Experience
            </div>
        </footer>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Mobile Sidebar Toggle JS -->
    <script>
        const toggleBtn = document.getElementById('toggleSidebarBtn');
        const sidebar = document.getElementById('adminSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        if (toggleBtn && sidebar && backdrop) {
            function toggleSidebar() {
                sidebar.classList.toggle('show');
                backdrop.classList.toggle('show');
            }

            toggleBtn.addEventListener('click', toggleSidebar);
            backdrop.addEventListener('click', toggleSidebar);
        }
    </script>
</body>
</html>
