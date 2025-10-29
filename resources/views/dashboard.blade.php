<x-layout>
    <div class="container-fluid">
        <h3 class="fw-bold mb-4">Dashboard</h3>

        <!-- ======= OVERVIEW CARDS ======= -->
        <div class="row g-4 mb-4">
            <div class="col-md-4 col-lg-2">
                <div class="card shadow-sm border-1 h-100">
                    <div class="card-body text-center">
                        <h4 class="fw-bold mb-1">{{ $studentCount ?? 0 }}</h4>
                        <p class="text-muted mb-0">Students</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="card shadow-sm border-1 h-100">
                    <div class="card-body text-center">
                        <h4 class="fw-bold mb-1">{{ $teacherCount ?? 0 }}</h4>
                        <p class="text-muted mb-0">Teachers</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="card shadow-sm border-1 h-100">
                    <div class="card-body text-center">
                        <h4 class="fw-bold mb-1">{{ $batchCount ?? 0 }}</h4>
                        <p class="text-muted mb-0">Batches</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="card shadow-sm border-1 h-100">
                    <div class="card-body text-center">
                        <h4 class="fw-bold mb-1">{{ $courseCount ?? 0 }}</h4>
                        <p class="text-muted mb-0">Courses</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="card shadow-sm border-1 h-100">
                    <div class="card-body text-center">
                        <h4 class="fw-bold mb-1">₹{{ number_format($totalPayments ?? 0) }}</h4>
                        <p class="text-muted mb-0">Total Payments</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="card shadow-sm border-1 h-100">
                    <div class="card-body text-center">
                        <h4 class="fw-bold mb-1">₹{{ number_format($totalExpenses ?? 0) }}</h4>
                        <p class="text-muted mb-0">Total Expenses</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
