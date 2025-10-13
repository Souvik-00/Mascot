<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'Dashboard' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #212529;
            color: white;
            padding: 20px 0;
            height: 100vh;
            position: fixed;
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

        /* Main content */
        .main {
            flex: 1;
            margin-left: 230px;
            padding: 30px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
   <div class="sidebar">
    <h4>Dashboard</h4>
    
    <!-- Dashboard Home -->
    <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">🏠 Home</a>

    <!-- Organisation Dropdown -->
    <div class="dropdown px-3 mt-2">
        <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            🏢 Organisation
        </button>
        <ul class="dropdown-menu w-60">
            <li>
                <a class="dropdown-item" 
                   href="{{ route('organisation.create') }}">
                    ➕ Add Organisation
                </a>
            </li>
            <li>
                <a class="dropdown-item" 
                   href="{{ route('organisation.index') }}">
                    📁 Organisation Directory
                </a>
            </li>
        </ul>
    </div>

     
    <!-- Teacher Dropdown -->
    <div class="dropdown px-3 mt-2">
        <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button"
            id="teacherDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            👩‍🏫 Teachers
        </button>
        <ul class="dropdown-menu" aria-labelledby="teacherDropdown">
            <li>
                <a class="dropdown-item {{ request()->is('teachers/create') ? 'active' : '' }}"
                    href="{{ route('teachers.create') }}">
                    ➕ Add Teacher
                </a>
            </li>
            <li>
                <a class="dropdown-item {{ request()->is('teachers') ? 'active' : '' }}"
                    href="{{ route('teachers.index') }}">
                    📁 Teacher Directory
                </a>
            </li>
        </ul>
    </div>

    <!-- Students Dropdown -->
    <div class="dropdown px-3 mt-2">
        <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button"
            id="studentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            🎓 Students
        </button>
        <ul class="dropdown-menu" aria-labelledby="studentDropdown">
            <li>
                <a class="dropdown-item {{ request()->is('students/create') ? 'active' : '' }}"
               href="{{ route('students.create') }}">
                ➕ Add Student
                </a>
            </li>
            <li>
            <a class="dropdown-item {{ request()->is('students') ? 'active' : '' }}"
               href="{{ route('students.index') }}">
                📁 Student Directory
            </a>
            </li>
        </ul>
    </div>


    <!-- Batch Dropdown -->
    <div class="dropdown px-3 mt-2">
        <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button"
            id="batchDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        📦 Batch
        </button>
        <ul class="dropdown-menu" aria-labelledby="batchDropdown">
        <li>
            <a class="dropdown-item {{ request()->is('batches.create') ? 'active' : '' }}"
               href="{{ route('batches.create') }}">
                ➕ Add Batch
            </a>
        </li>
        <li>
            <a class="dropdown-item {{ request()->is('batches') ? 'active' : '' }}"
               href="{{ route('batches.index') }}">
                📁 Batch Directory
            </a>
        </li>
        </ul>
    </div>


    <!-- Classrooms Dropdown -->
    <div class="dropdown px-3 mt-2">
        <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button"
            id="classDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        📘 Classrooms
        </button>
        <ul class="dropdown-menu" aria-labelledby="classDropdown">
            <li>
            <a class="dropdown-item {{ request()->is('classrooms/create') ? 'active' : '' }}"
               href="{{ route('classrooms.create') }}">
                ➕ Add Classroom
            </a>
            </li>
            <li>
            <a class="dropdown-item {{ request()->is('classrooms') ? 'active' : '' }}"
               href="{{ route('classrooms.index') }}">
                📁 Classroom Directory
            </a>
            </li>
        </ul>
    </div>


    <!-- Class Sessions Dropdown -->
    <div class="dropdown px-3 mt-2">
        <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button"
            id="classSessionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        🕒 Class Sessions
        </button>
        <ul class="dropdown-menu" aria-labelledby="classSessionDropdown">
        <li>
            <a class="dropdown-item {{ request()->is('class-sessions/create') ? 'active' : '' }}"
               href="{{ route('class-sessions.create') }}">
                ➕ Add Class Session
            </a>
        </li>
        <li>
            <a class="dropdown-item {{ request()->is('class-sessions') ? 'active' : '' }}"
               href="{{ route('class-sessions.index') }}">
                📁 Session Directory
            </a>
        </li>
        </ul>
    </div>


    <!-- Schedules Dropdown -->
    <div class="dropdown px-3 mt-2">
        <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button"
            id="scheduleDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        🗓️ Schedules
        </button>
        <ul class="dropdown-menu" aria-labelledby="scheduleDropdown">
        <li>
            <a class="dropdown-item {{ request()->is('schedules/create') ? 'active' : '' }}"
               href="{{ route('schedules.create') }}">
                ➕ Add Schedule
            </a>
        </li>
        <li>
            <a class="dropdown-item {{ request()->is('schedules') ? 'active' : '' }}"
               href="{{ route('schedules.index') }}">
                📁 Schedule Directory
            </a>
        </li>
        </ul>
    </div>


    <!-- Payments Dropdown -->
    <div class="dropdown px-3 mt-2">
        <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button"
            id="paymentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        💰 Payments
        </button>
        <ul class="dropdown-menu" aria-labelledby="paymentDropdown">
        <li>
            <a class="dropdown-item {{ request()->is('payments/create') ? 'active' : '' }}"
               href="{{ route('payments.create') }}">
                ➕ Add Payment
            </a>
        </li>
        <li>
            <a class="dropdown-item {{ request()->is('payments') ? 'active' : '' }}"
               href="{{ route('payments.index') }}">
                📁 Payment Directory
            </a>
        </li>
        </ul>
    </div>


    <!-- Expenses Dropdown -->
    <div class="dropdown px-3 mt-2">
        <button class="btn btn-dark w-100 dropdown-toggle text-start" type="button"
            id="expenseDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        💸 Expenses
        </button>
        <ul class="dropdown-menu" aria-labelledby="expenseDropdown">
        <li>
            <a class="dropdown-item {{ request()->is('expenses/create') ? 'active' : '' }}"
               href="{{ route('expenses.create') }}">
                ➕ Add Expense
            </a>
        </li>
        <li>
            <a class="dropdown-item {{ request()->is('expenses') ? 'active' : '' }}"
               href="{{ route('expenses.index') }}">
                📁 Expense Directory
            </a>
        </li>
        </ul>
    </div>


    
    <form method="POST" action="{{ route('logout') }}" class="mt-5 px-3">
        @csrf
        <button type="submit" class="btn btn-danger w-100">Logout</button>
    </form>
    </div>

    
    
    <!-- Main Content -->
    <div class="main">
        {{ $slot }}
    </div>

</body>
</html>
