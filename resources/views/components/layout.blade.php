<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Mascot' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        /* Sidebar (Desktop) */
        .sidebar {
            width: 250px;
            background-color: #212529;
            color: white;
            padding: 20px 0;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }

        .sidebar h4 {
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #adb5bd;
            text-decoration: none;
            padding: 8px 20px;
            transition: all 0.2s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #495057;
            color: #fff;
        }

        /* Navbar */
        .navbar-custom {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 1030;
        }

        .navbar-brand {
            font-weight: 600;
            color: #212529 !important;
        }

        /* Main content */
        .main {
            margin-left: 250px;
            margin-top: 70px;
            padding: 30px;
        }

        .collapse a {
            font-size: 0.95rem;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar d-none d-lg-block">
        <h4 class="text-center mb-4">📊 Dashboard</h4>

        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">🏠 Home</a>

        <!-- PEOPLE -->
        <h6 class="text-uppercase text-secondary mt-4 px-3">People</h6>

        <!-- Students -->
        <div class="px-3 mt-2">
            <button class="btn btn-dark w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#studentsMenu" aria-expanded="{{ request()->is('students*') ? 'true' : 'false' }}">
                🎓 Students
            </button>
            <div class="collapse {{ request()->is('students*') ? 'show' : '' }}" id="studentsMenu">
                <a href="{{ route('students.index') }}">📋 Student List</a>
                <a href="{{ route('students.search') }}">🔍 Search Student</a>
                <a href="{{ route('students.create') }}">➕ New Student</a>
            </div>
        </div>

        <!-- Teachers -->
        <div class="px-3 mt-2">
            <button class="btn btn-dark w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#teachersMenu" aria-expanded="{{ request()->is('teachers*') ? 'true' : 'false' }}">
                👩‍🏫 Teachers
            </button>
            <div class="collapse {{ request()->is('teachers*') ? 'show' : '' }}" id="teachersMenu">
                <a href="{{ route('teachers.index') }}">📋 Teacher List</a>
                <a href="{{ route('teachers.search') }}">🔍 Search Teacher</a>
                <a href="{{ route('teachers.create') }}">➕ New Teacher</a>
            </div>
        </div>

        <!-- ACADEMICS -->
        <h6 class="text-uppercase text-secondary mt-4 px-3">Academics</h6>

        <!-- Courses -->
        <div class="px-3 mt-2">
            <button class="btn btn-dark w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#coursesMenu" aria-expanded="{{ request()->is('courses*') ? 'true' : 'false' }}">
                📚 Courses
            </button>
            <div class="collapse {{ request()->is('courses*') ? 'show' : '' }}" id="coursesMenu">
                <a href="{{ route('courses.index') }}">📋 Course List</a>
                <a href="{{ route('courses.search') }}">🔍 Search Course</a>
                <a href="{{ route('courses.create') }}">➕ New Course</a>
            </div>
        </div>

        <!-- Batches -->
        <div class="px-3 mt-2">
            <button class="btn btn-dark w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#batchesMenu" aria-expanded="{{ request()->is('batches*') ? 'true' : 'false' }}">
                📦 Batches
            </button>
            <div class="collapse {{ request()->is('batches*') ? 'show' : '' }}" id="batchesMenu">
                <a href="{{ route('batches.index') }}">📋 Batch List</a>
                <a href="{{ route('batches.search') }}">🔍 Search Batch</a>
                <a href="{{ route('batches.create') }}">➕ New Batch</a>
            </div>
        </div>

        <!-- Schedules -->
        <div class="px-3 mt-2">
            <button class="btn btn-dark w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#schedulesMenu" aria-expanded="{{ request()->is('schedules*') ? 'true' : 'false' }}">
                🗓️ Schedules
            </button>
            <div class="collapse {{ request()->is('schedules*') ? 'show' : '' }}" id="schedulesMenu">
                <a href="{{ route('schedules.index') }}">📋 Schedule List</a>
                <a href="{{ route('schedules.create') }}">➕ New Schedule</a>
            </div>
        </div>

        <!-- FINANCE -->
        <h6 class="text-uppercase text-secondary mt-4 px-3">Finance</h6>

         <!-- Payments -->
        <div class="px-3 mt-2">
            <button class="btn btn-dark w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#paymentsMenu" aria-expanded="{{ request()->is('payments*') ? 'true' : 'false' }}">
                💰 Payments
            </button>
            <div class="collapse {{ request()->is('payments*') ? 'show' : '' }}" id="paymentsMenu">
                <a href="{{ route('payments.index') }}">📋 All Payments</a>
                <a href="{{ route('payments.create') }}">➕ Record Payment</a>
            </div>
        </div>

        <!-- Expenses -->
        <div class="px-3 mt-2">
            <button class="btn btn-dark w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#expensesMenu" aria-expanded="{{ request()->is('expenses*') ? 'true' : 'false' }}">
                💸 Expenses
            </button>
            <div class="collapse {{ request()->is('expenses*') ? 'show' : '' }}" id="expensesMenu">
                <a href="{{ route('expenses.index') }}">📋 All Expenses</a>
                <a href="{{ route('expenses.create') }}">➕ New Expense</a>
            </div>
        </div>

        <!-- REPORTS & ANALYTICS -->
        <h6 class="text-uppercase text-secondary mt-4 px-3">Reports & Analytics</h6>

        <div class="px-3 mt-2">
            <button class="btn btn-dark w-100 text-start" type="button" data-bs-toggle="collapse"
            data-bs-target="#reportsMenu" aria-expanded="false">
            📊 Reports & Analytics
            </button>
        <div class="collapse {{ request()->is('reports*') ? 'show' : '' }}" id="reportsMenu">
        
            <!-- Students -->
        <h6 class="text-light mt-3">👩‍🎓 Students</h6>
            <a href="#" class="px-3 d-block text-decoration-none text-light">📘 Students in Progress</a>
            <a href="#" class="px-3 d-block text-decoration-none text-light">🎓 Students Completed</a>

        
            <!-- Teachers -->
        <h6 class="text-light mt-3">👨‍🏫 Teachers</h6>
            <a href="#" class="px-3 d-block text-decoration-none text-light">🟢 Active Teachers</a>
            <a href="#" class="px-3 d-block text-decoration-none text-light">⚫ Inactive Teachers</a>

        
            <!-- Batches -->
        <h6 class="text-light mt-3">📦 Batches</h6>
            <a href="#" class="px-3 d-block text-decoration-none text-light">🕒 Current Batches</a>

        
            <!-- Courses -->
        <h6 class="text-light mt-3">📚 Courses</h6>
            <a href="#" class="px-3 d-block text-decoration-none text-light">📘 Current Courses</a>

        
            <!-- Finance -->
        <h6 class="text-light mt-3">💰 Finance</h6>
            <a href="#" class="px-3 d-block text-decoration-none text-light">💵 Payments Received (This Month)</a>
            <a href="#" class="px-3 d-block text-decoration-none text-light">⏳ Due Payments</a>
            <a href="#" class="px-3 d-block text-decoration-none text-light">💸 All Expenses</a>
            <a href="#" class="px-3 d-block text-decoration-none text-light">📅 This Month’s Expenses</a>
            <a href="#" class="px-3 d-block text-decoration-none text-light">📈 Marketing Expenses</a>
            <a href="#" class="px-3 d-block text-decoration-none text-light">👷 Manpower Expenses</a>
            <a href="#" class="px-3 d-block text-decoration-none text-light">🧾 Other Expenses (This Month)</a>
        </div>
    </div>

        <!-- ADMINISTRATION -->
        <h6 class="text-uppercase text-secondary mt-4 px-3">Administration</h6>
            <a href="{{ route('organisation.create') }}" class="px-3 d-block text-decoration-none text-light">🏢 Create Organization </a>
            <a href="{{ route('organisation.index') }}" class="px-3 d-block text-decoration-none text-light">🏢 Organization Profile</a>
            <a href="{{ route('users.create') }}" class="px-3 d-block text-decoration-none text-light">👥 New User</a>
            <a href="#" class="px-3 d-block text-decoration-none text-light">🛡️ Roles & Permissions</a>

        <!-- Master Data & System -->
    <div class="px-3 mt-3">
        <button class="btn btn-dark w-100 text-start" type="button" data-bs-toggle="collapse"
            data-bs-target="#masterDataMenu" aria-expanded="false">
            ⚙️ Master Data
        </button>

        <div class="collapse {{ request()->is('master*') ? 'show' : '' }}" id="masterDataMenu">
        
            <!-- Master Data -->
        <h6 class="text-light mt-3">📚 Master Data</h6>
            <a href="#" class="px-3 d-block text-decoration-none text-light">💼 Expense Heads</a>
            <a href="#" class="px-3 d-block text-decoration-none text-light">💳 Payment Methods</a>
            <a href="#" class="px-3 d-block text-decoration-none text-light">🏷️ Course Categories</a>

        
            <!-- Notifications -->
        <h6 class="text-light mt-3">🔔 Notifications</h6>
            <a href="#" class="px-3 d-block text-decoration-none text-light">✉️ Email / SMS Templates</a>
            <a href="#" class="px-3 d-block text-decoration-none text-light">🔗 Integrations (Gateway / SMS / Email)</a>

       
            <!-- System -->
        <h6 class="text-light mt-3">🧾 System</h6>
            <a href="#" class="px-3 d-block text-decoration-none text-light">📜 Audit Log</a>
            <a href="#" class="px-3 d-block text-decoration-none text-light">💾 Backups</a>
        </div>
    </div>



    <!-- ================= HELP ================= -->
        <h6 class="text-uppercase text-secondary mt-4 px-3">Help</h6>

    <div class="px-3 mt-2">
            <button class="btn btn-dark w-100 text-start" type="button"
            data-bs-toggle="collapse" data-bs-target="#helpMenu" aria-expanded="false">
            🆘 Help & Support
            </button>

        <div class="collapse {{ request()->is('help*') ? 'show' : '' }}" id="helpMenu">
            <a href="#" class="px-3 d-block text-decoration-none text-light">📘 Documentation</a>
            <a href="#" class="px-3 d-block text-decoration-none text-light">☎️ Contact Support</a>
        </div>
    </div>

        <!-- ACCOUNT -->
        <h6 class="text-uppercase text-secondary mt-4 px-3">Account</h6>
            <a href="{{ route('users.profile') }}" class="px-3 d-block text-decoration-none text-light">👤 Profile</a>

        <form method="POST" action="{{ route('logout') }}" class="mt-3 px-3">
            @csrf
            <button type="submit" class="btn btn-danger w-100">🚪 Sign Out</button>
        </form>
    </div>


        <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand ms-3">Mascot Dashboard</span>
            <div class="ms-auto me-3">
                <span class="me-3">👋 {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    
    <!-- Main Content -->
    <main class="main">
        {{ $slot }}
    </main>
</body>
</html>
