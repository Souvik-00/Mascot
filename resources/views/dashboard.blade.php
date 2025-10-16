<x-layout title="Mascot">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Welcome, {{ Auth::user()->name }}</h2>
    </div>

    <div class="row g-4">
        <!-- Students -->
        <div class="col-md-4 col-lg-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="text-secondary">🎓 Students</h5>
                    <h2 class="fw-bold text-primary">{{ $studentCount }}</h2>
                </div>
            </div>
        </div>

        <!-- Teachers -->
        <div class="col-md-4 col-lg-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="text-secondary">👩‍🏫 Teachers</h5>
                    <h2 class="fw-bold text-success">{{ $teacherCount }}</h2>
                </div>
            </div>
        </div>

        <!-- Batches -->
        <div class="col-md-4 col-lg-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="text-secondary">📦 Batches</h5>
                    <h2 class="fw-bold text-warning">{{ $batchCount }}</h2>
                </div>
            </div>
        </div>

        <!-- Classrooms -->
        <div class="col-md-4 col-lg-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="text-secondary">📘 Classrooms</h5>
                    <h2 class="fw-bold text-info">{{ $classCount }}</h2>
                </div>
            </div>
        </div>

        <!-- Payments -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="text-secondary">💰 Total Payments</h5>
                    <h2 class="fw-bold text-success">₹{{ number_format($totalPayments, 2) }}</h2>
                </div>
            </div>
        </div>

        <!-- Expenses -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="text-secondary">💸 Total Expenses</h5>
                    <h2 class="fw-bold text-danger">₹{{ number_format($totalExpenses, 2) }}</h2>
                </div>
            </div>
        </div>

        <!-- Profit or Loss -->
        <div class="col-md-12 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="text-secondary">📊 Net Balance</h5>
                    @php
                        $net = $totalPayments - $totalExpenses;
                        $netColor = $net >= 0 ? 'text-success' : 'text-danger';
                    @endphp
                    <h2 class="fw-bold {{ $netColor }}">
                        ₹{{ number_format($net, 2) }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
</x-layout>
