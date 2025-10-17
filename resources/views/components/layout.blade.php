<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Mascot Dashboard' }}</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fb;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #ffffff;
            border-right: 1px solid #dee2e6;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar h4 {
            font-weight: 600;
            color: #0d6efd;
            text-align: center;
            margin: 1rem 0;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed h4 {
            opacity: 0;
        }

        .sidebar h6 {
            color: #6c757d;
            font-size: 0.75rem;
            margin-top: 1rem;
            padding-left: 1rem;
            text-transform: uppercase;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed h6 {
            opacity: 0;
        }

        .sidebar a,
        .sidebar button {
            display: block;
            color: #333;
            text-decoration: none;
            padding: 8px 20px;
            font-size: 0.95rem;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .sidebar a:hover,
        .sidebar button:hover {
            background-color: #f1f3f5;
            color: #0d6efd;
        }

        .sidebar .collapse a {
            font-size: 0.9rem;
            padding-left: 35px;
        }

        .sidebar.collapsed a span,
        .sidebar.collapsed button span {
            display: none;
        }

        /* ========== NAVBAR ========== */
        .navbar-custom {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            z-index: 1030;
            transition: all 0.3s ease;
            padding: 0.75rem 1rem;
        }

        .navbar-custom.collapsed {
            left: 80px;
        }

        .navbar-brand {
            font-weight: 600;
            color: #212529 !important;
        }

        .hamburger {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #333;
        }

        /* ========== MAIN CONTENT ========== */
        .main {
            margin-left: 220px;
            margin-top: 60px;
            margin-right: -30px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .main.collapsed {
            margin-left: 80px;
        }

        /* Scrollbar fix */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <!-- ===== Sidebar ===== -->
    <aside class="sidebar" id="sidebar">
        <h4>📊 Mascot</h4>

        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i><span>Dashboard</span>
        </a>

        <!-- People -->
        <h6>People</h6>

        <button class="btn" data-bs-toggle="collapse" data-bs-target="#studentsMenu">
            🎓 <span>Students</span>
        </button>
        <div class="collapse {{ request()->is('students*') ? 'show' : '' }}" id="studentsMenu">
            <a href="{{ route('students.index') }}">📋 List</a>
            <a href="{{ route('students.search') }}">🔍 Search</a>
            <a href="{{ route('students.create') }}">➕ New</a>
        </div>

        <button class="btn" data-bs-toggle="collapse" data-bs-target="#teachersMenu">
            👩‍🏫 <span>Teachers</span>
        </button>
        <div class="collapse {{ request()->is('teachers*') ? 'show' : '' }}" id="teachersMenu">
            <a href="{{ route('teachers.index') }}">📋 List</a>
            <a href="{{ route('teachers.search') }}">🔍 Search</a>
            <a href="{{ route('teachers.create') }}">➕ New</a>
        </div>

        <!-- Academics -->
        <h6>Academics</h6>

        <button class="btn" data-bs-toggle="collapse" data-bs-target="#coursesMenu">
            📚 <span>Courses</span>
        </button>
        <div class="collapse {{ request()->is('courses*') ? 'show' : '' }}" id="coursesMenu">
            <a href="{{ route('courses.index') }}">📋 List</a>
            <a href="{{ route('courses.search') }}">🔍 Search</a>
            <a href="{{ route('courses.create') }}">➕ New</a>
        </div>

        <button class="btn" data-bs-toggle="collapse" data-bs-target="#batchesMenu">
            📦 <span>Batches</span>
        </button>
        <div class="collapse {{ request()->is('batches*') ? 'show' : '' }}" id="batchesMenu">
            <a href="{{ route('batches.index') }}">📋 List</a>
            <a href="{{ route('batches.search') }}">🔍 Search</a>
            <a href="{{ route('batches.create') }}">➕ New</a>
        </div>

        <button class="btn" data-bs-toggle="collapse" data-bs-target="#schedulesMenu">
            🗓️ <span>Schedules</span>
        </button>
        <div class="collapse {{ request()->is('schedules*') ? 'show' : '' }}" id="schedulesMenu">
            <a href="{{ route('schedules.index') }}">📋 List</a>
            <a href="{{ route('schedules.create') }}">➕ New</a>
        </div>

        <!-- Finance -->
        <h6>Finance</h6>

        <button class="btn" data-bs-toggle="collapse" data-bs-target="#paymentsMenu">
            💰 <span>Payments</span>
        </button>
        <div class="collapse {{ request()->is('payments*') ? 'show' : '' }}" id="paymentsMenu">
            <a href="{{ route('payments.index') }}">📋 All Payments</a>
            <a href="{{ route('payments.create') }}">➕ Record Payment</a>
        </div>

        <button class="btn" data-bs-toggle="collapse" data-bs-target="#expensesMenu">
            💸 <span>Expenses</span>
        </button>
        <div class="collapse {{ request()->is('expenses*') ? 'show' : '' }}" id="expensesMenu">
            <a href="{{ route('expenses.index') }}">📋 All Expenses</a>
            <a href="{{ route('expenses.create') }}">➕ New Expense</a>
        </div>

        <!-- Administration -->
        <h6>Administration</h6>
        <a href="{{ route('organisation.index') }}">🏢 <span>Organization</span></a>
        <a href="{{ route('users.create') }}">👥 <span>New User</span></a>
        <a href="#">🛡️ <span>Roles & Permissions</span></a>

        <button class="btn" data-bs-toggle="collapse" data-bs-target="#masterDataMenu">
            ⚙️ <span>Master Data</span>
        </button>
        <div class="collapse" id="masterDataMenu">
            <a href="#">💼 Expense Heads</a>
            <a href="#">💳 Payment Methods</a>
            <a href="#">🏷️ Course Categories</a>
            <a href="#">✉️ Email/SMS Templates</a>
            <a href="#">🔗 Integrations</a>
            <a href="#">📜 Audit Log</a>
            <a href="#">💾 Backups</a>
        </div>

        <!-- Help -->
        <h6>Help</h6>
        <button class="btn" data-bs-toggle="collapse" data-bs-target="#helpMenu">
            🆘 <span>Help & Support</span>
        </button>
        <div class="collapse" id="helpMenu">
            <a href="#">📘 Documentation</a>
            <a href="#">☎️ Contact Support</a>
        </div>

        <!-- Account -->
        <h6>Account</h6>
        <a href="{{ route('users.profile') }}">👤 <span>Profile</span></a>

        <form method="POST" action="{{ route('logout') }}" class=" mt-3 mb-4">
            @csrf
            {{-- <button type="submit" class="btn btn-danger w-100" data-bs-toggle="collapse" data-bs-target="#helpMenu">🚪 Sign Out</button> --}}
            <button>🚪<span>Sign Out</span></button>
        </form>
    </aside>

    <!-- ===== Navbar ===== -->
    <nav class="navbar navbar-expand-lg navbar-custom" id="navbar">
        <div class="container-fluid">
            <button class="hamburger me-3" id="toggleSidebar"><i class="bi bi-list"></i></button>
            <span class="navbar-brand">Good Morning, {{ Auth::user()->name }} 👋</span>

            <form class="d-flex ms-auto me-4">
                <input class="form-control form-control-sm me-2" type="search" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-primary btn-sm"><i class="bi bi-search"></i></button>
            </form>

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" alt="Avatar" width="32" height="32" class="rounded-circle me-2">
                    <span>{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li><a class="dropdown-item" href="{{ route('users.profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ===== Main Content ===== -->
    <main class="main" id="main">
    <div class="container-fluid px-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</main>


    <!-- ===== Scripts ===== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const navbar = document.getElementById('navbar');
        const main = document.getElementById('main');
        const toggleBtn = document.getElementById('toggleSidebar');

        // Restore sidebar state from localStorage
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            sidebar.classList.add('collapsed');
            navbar.classList.add('collapsed');
            main.classList.add('collapsed');
        }

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            navbar.classList.toggle('collapsed');
            main.classList.toggle('collapsed');

            // Save state
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        });
    </script>
</body>
</html>
