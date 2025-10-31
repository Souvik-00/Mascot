<x-layout>
    <div class="container mt-4">
        {{-- 🧾 Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0 text-primary">
                <i class="bi bi-graph-up"></i> Departmentwise Expense Report
            </h4>
            <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Expenses
            </a>
        </div>

        {{-- 📊 Report Body --}}
        @if ($reports->count())
            @php
                $currentDepartment = null;
                $currentCategory = null;
                $departmentTotal = 0;
            @endphp

            @foreach ($reports as $row)
                {{-- 🏫 Department Section --}}
                @if ($currentDepartment !== $row->department)
                    {{-- Close previous department card with total --}}
                    @if (!is_null($currentDepartment))
                            <hr class="my-2">
                            <div class="text-end mt-2 fw-bold text-success">
                                Grand Total: ₹{{ number_format($departmentTotal, 2) }}
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Start new Department Card --}}
                    <div class="card shadow-sm mb-4 border-0">
                        <div class="card-header bg-gradient bg-primary text-white fw-bold">
                            <i class="bi bi-building me-1"></i> {{ $row->department }}
                        </div>
                        <div class="card-body">
                            @php
                                $currentDepartment = $row->department;
                                $currentCategory = null;
                                $departmentTotal = 0;
                            @endphp
                @endif

                {{-- 📁 Category Section --}}
                @if ($currentCategory !== $row->category)
                    <h6 class="fw-semibold text-secondary border-start border-3 border-secondary ps-2 mt-3 mb-2">
                        <i class="bi bi-folder2-open me-1"></i> {{ $row->category ?? '—' }}
                    </h6>
                    @php $currentCategory = $row->category; @endphp
                @endif

                {{-- 💸 Subcategory Row --}}
                <div class="d-flex justify-content-between align-items-center ps-4 border-bottom py-2">
                    <div>
                        <span class="fw-semibold">{{ $row->subcategory ?? '—' }}</span><br>
                        <small class="text-muted">
                            <i class="bi bi-calendar3"></i>
                            {{ \Carbon\Carbon::parse($row->expense_date)->format('d M Y') }}
                        </small>
                    </div>
                    <div class="fw-bold text-success fs-6">
                        ₹{{ number_format($row->total_expense, 2) }}
                    </div>
                </div>

                @php
                    $departmentTotal += $row->total_expense;
                @endphp

                {{-- Close last department card --}}
                @if ($loop->last)
                        <hr class="my-2">
                        <div class="text-end mt-2 fw-bold text-success">
                            Grand Total: ₹{{ number_format($departmentTotal, 2) }}
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle"></i> No expense records found.
            </div>
        @endif
    </div>
</x-layout>
