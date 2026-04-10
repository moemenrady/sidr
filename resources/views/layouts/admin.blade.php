<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #0f172a; /* Dark Slate */
            --sidebar-hover: #1e293b;
            --topbar-bg: #ffffff;
            --body-bg: #f8fafc; /* Light Gray */
            --primary: #4f46e5; /* Indigo */
            --primary-hover: #4338ca;
            --text-dark: #1e293b;
            --text-light: #94a3b8;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--body-bg);
            color: var(--text-dark);
            overflow-x: hidden; /* يمنع التمرير الأفقي غير المرغوب فيه */
        }

        /* --- Animations --- */
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-content {
            animation: fadeSlideUp 0.6s ease-out forwards;
        }

        /* --- Layout Wrapper --- */
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            min-height: 100vh;
        }

        /* --- Sidebar --- */
        .sidebar {
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: #fff;
            transition: var(--transition);
            z-index: 1030;
            position: relative;
            box-shadow: 4px 0 10px rgba(0,0,0,0.05);
        }

        .sidebar-header {
            padding: 20px;
            font-size: 1.25rem;
            font-weight: 700;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .sidebar .nav-link {
            color: var(--text-light);
            padding: 12px 20px;
            margin: 4px 15px;
            border-radius: 8px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .sidebar .nav-link i {
            width: 25px; /* توحيد مساحة الأيقونات لتكون النصوص على نفس الخط */
            font-size: 1.1rem;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background: var(--sidebar-hover);
            transform: translateX(5px); /* أنيميشن بسيط عند الـ Hover */
        }

        /* --- Top Navbar --- */
        .navbar-custom {
            background: var(--topbar-bg);
            box-shadow: var(--shadow-sm);
            padding: 15px 25px;
            z-index: 1020;
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--text-dark) !important;
        }

        /* --- Main Content Area --- */
        .main-panel {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0; /* Important for flexbox to not overflow */
            transition: var(--transition);
        }

        .content-body {
            padding: 30px;
            flex: 1;
        }

        /* --- Buttons --- */
        .back-btn {
            background-color: var(--primary);
            color: #fff;
            font-weight: 500;
            border-radius: 10px;
            padding: 10px 20px;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
            color: #fff;
        }

        /* --- Mobile Overlay --- */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(2px);
            z-index: 1025;
            opacity: 0;
            transition: var(--transition);
        }

        /* --- Responsive Design (Mobile & Tablet) --- */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                height: 100vh;
                left: calc(-1 * var(--sidebar-width)); /* إخفاء القائمة خارج الشاشة */
            }

            .sidebar.show {
                left: 0; /* إظهار القائمة */
            }

            .sidebar-overlay.show {
                display: block;
                opacity: 1;
            }

            .content-body {
                padding: 15px; /* تقليل المسافات في الموبايل */
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    <div class="wrapper">

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <i class="fa fa-shield-halved me-2 text-primary"></i> Admin Panel
            </div>
            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a href="{{ route('admin.collections.create') }}" class="nav-link">
                        <i class="fa fa-layer-group"></i> Collections
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.products.create') }}" class="nav-link">
                        <i class="fa fa-box-open"></i> Add Products
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.orders.index') }}" class="nav-link">
                        <i class="fa fa-cart-shopping"></i> Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.hero.edit') }}" class="nav-link">
                        <i class="fa fa-image"></i> Site Cover Image
                    </a>
                </li>
            </ul>
        </nav>

        <div class="main-panel">

            <header class="navbar navbar-expand-lg navbar-custom">
                <div class="container-fluid px-0">
                    <div class="d-flex align-items-center">
                        <button type="button" id="sidebarToggle" class="btn btn-light d-md-none me-3 shadow-sm">
                            <i class="fa fa-bars"></i>
                        </button>
                        <span class="navbar-brand mb-0 h1">@yield('title', 'home')</span>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <div class="dropdown">
                            <span class="fw-medium text-dark ms-2"><i class="fa fa-user-circle fs-5 align-middle me-1"></i> Admin</span>
                        </div>
                    </div>
                </div>
            </header>

            <main class="content-body animate-content">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                    <a href="{{ route('home') }}" class="back-btn">
                        <i class="fa fa-arrow-left"></i> Back to Client View
                    </a>
                    </div>

                <div class="bg-white p-4 rounded-3 shadow-sm border-0">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            // فتح وإغلاق القائمة
            function toggleSidebar() {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            }

            // تفعيل الزر
            if(sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            // إغلاق القائمة عند الضغط على الخلفية السوداء (Overlay) في الموبايل
            if(sidebarOverlay) {
                sidebarOverlay.addEventListener('click', toggleSidebar);
            }
        });
    </script>
    
    @stack('scripts')
</body>

</html>