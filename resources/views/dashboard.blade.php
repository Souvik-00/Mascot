<x-layout>
    <div class="container-fluid">
        <h3 class="fw-bold mb-4">Dashboard</h3>

        <!-- ======= METRIC CARDS ======= -->
        <div class="row g-4 mb-4">
            <div class="col-md-4 col-lg-2">
                <div class="metric-card">
                    <h4>{{ $studentsCount ?? 0 }}</h4>
                    <p>Students</p>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="metric-card">
                    <h4>{{ $teachersCount ?? 0 }}</h4>
                    <p>Teachers</p>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="metric-card">
                    <h4>{{ $batchesCount ?? 0 }}</h4>
                    <p>Batches</p>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="metric-card">
                    <h4>{{ $coursesCount ?? 0 }}</h4>
                    <p>Courses</p>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="metric-card">
                    <h4>₹{{ number_format($paymentsTotal ?? 0) }}</h4>
                    <p>Total Payments</p>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="metric-card">
                    <h4>₹{{ number_format($expensesTotal ?? 0) }}</h4>
                    <p>Total Expenses</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
