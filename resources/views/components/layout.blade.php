<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>

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
            padding: 12px 20px;
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
    </style>
</head>

<body>

    <!-- Sidebar (Desktop) -->
    <div class="sidebar d-none d-lg-block">
        <h4>Mascot</h4>

        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">🏠 Home</a>

        <!-- Organisation -->
        <div class="dropdown px-3 mt-2">
            <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button" data-bs-toggle="dropdown">
                🏢 Organisation
            </button>
            <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="{{ route('organisation.create') }}">➕ Add Organisation</a></li>
                <li><a class="dropdown-item" href="{{ route('organisation.index') }}">📁 Directory</a></li>
            </ul>
        </div>

        <!-- Teachers -->
        <div class="dropdown px-3 mt-2">
            <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button" data-bs-toggle="dropdown">
                👩‍🏫 Teachers
            </button>
            <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="{{ route('teachers.create') }}">➕ Add Teacher</a></li>
                <li><a class="dropdown-item" href="{{ route('teachers.index') }}">📁 Directory</a></li>
            </ul>
        </div>

        <!-- Students -->
        <div class="dropdown px-3 mt-2">
            <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button" data-bs-toggle="dropdown">
                🎓 Students
            </button>
            <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="{{ route('students.create') }}">➕ Add Student</a></li>
                <li><a class="dropdown-item" href="{{ route('students.index') }}">📁 Directory</a></li>
            </ul>
        </div>

        <!-- Batches -->
        <div class="dropdown px-3 mt-2">
            <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button" data-bs-toggle="dropdown">
                📦 Batches
            </button>
            <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="{{ route('batches.create') }}">➕ Add Batch</a></li>
                <li><a class="dropdown-item" href="{{ route('batches.index') }}">📁 Directory</a></li>
            </ul>
        </div>

        <!-- Classrooms -->
        <div class="dropdown px-3 mt-2">
            <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button" data-bs-toggle="dropdown">
                📘 Classrooms
            </button>
            <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="{{ route('classrooms.create') }}">➕ Add Classroom</a></li>
                <li><a class="dropdown-item" href="{{ route('classrooms.index') }}">📁 Directory</a></li>
            </ul>
        </div>

        <!-- Schedules -->
        <div class="dropdown px-3 mt-2">
            <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button" data-bs-toggle="dropdown">
                🗓️ Schedules
            </button>
            <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="{{ route('schedules.create') }}">➕ Add Schedule</a></li>
                <li><a class="dropdown-item" href="{{ route('schedules.index') }}">📁 Directory</a></li>
            </ul>
        </div>

        <!-- Payments -->
        <div class="dropdown px-3 mt-2">
            <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button" data-bs-toggle="dropdown">
                💰 Payments
            </button>
            <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="{{ route('payments.create') }}">➕ Add Payment</a></li>
                <li><a class="dropdown-item" href="{{ route('payments.index') }}">📁 Directory</a></li>
            </ul>
        </div>

        <!-- Expenses -->
        <div class="dropdown px-3 mt-2 mb-5">
            <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button" data-bs-toggle="dropdown">
                💸 Expenses
            </button>
            <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="{{ route('expenses.create') }}">➕ Add Expense</a></li>
                <li><a class="dropdown-item" href="{{ route('expenses.index') }}">📁 Directory</a></li>
            </ul>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-custom navbar-expand-lg">
        <div class="container-fluid px-4">

            <a class="navbar-brand ms-2" href="{{ route('dashboard') }}">Mascot Admin Panel</a>

            <div class="d-flex align-items-center ms-auto">
                <span class="me-3 text-muted">👤 {{ Auth::user()->name ?? 'Admin' }}</span>
                <form method="POST" action="{{ route('logout') }}">
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
