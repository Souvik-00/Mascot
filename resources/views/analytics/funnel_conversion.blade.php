<x-layout>
    <div class="container-fluid">

        <h3 class="fw-bold mb-4"
            style="font-family: Ghost, 'Helvetica Neue', Helvetica, sans-serif; font-size: 20px; font-weight: 500; line-height: 60px; color: rgb(33, 37, 41);">
            Funnel & Conversion Analytics
        </h3>

       <div class="row g-4 mb-4">

        {{-- Conversion Percentage --}}
        <div class="col-md-4 col-lg-4">
            <div class="card shadow-sm border-1 text-center h-100 py-3">
            
            @php
                $isGood = $conversionPercentage >= 60;
            @endphp

            <h5 class="fw-bold mb-1 d-flex justify-content-center align-items-center gap-1">
                {{ $conversionPercentage }}%

                @if($isGood)
                    <i class="bi bi-hand-thumbs-up-fill" style="color: green; font-size: 20px;"></i>
                @else
                    <i class="bi bi-hand-thumbs-down-fill" style="color: red; font-size: 20px;"></i>
                @endif
            </h5>

            <p class="text-muted small mb-0">Contactiblity Benchmark (>= 60%)</p>
            </div>
        </div>

    
        {{-- Mql --}}
        <div class="col-md-4 col-lg-4">
        <div class="card shadow-sm border-1 text-center h-100 py-3">
            @php
                $isGood = $mqlCount >= 40;
            @endphp

            <h5 class="fw-bold mb-1 d-flex justify-content-center align-items-center gap-1">
                {{ $mqlCount }}%

                @if($isGood)
                    <i class="bi bi-hand-thumbs-up-fill" style="color: green; font-size: 20px;"></i>
                @else
                    <i class="bi bi-hand-thumbs-down-fill" style="color: red; font-size: 20px;"></i>
                @endif
            </h5>
            <p class="text-muted small mb-0">Quality Of Initial Qualification (>= 40%)</p>
        </div>
    </div>

    <div class="col-md-4 col-lg-4">
        <div class="card shadow-sm border-1 text-center h-100 py-3">
            <h5 class="fw-bold mb-1"></h5>
            <p class="text-muted small mb-0">Batches</p>
        </div>
    </div>

    <div class="col-md-4 col-lg-4">
        <div class="card shadow-sm border-1 text-center h-100 py-3">
            <h5 class="fw-bold mb-1"></h5>
            <p class="text-muted small mb-0">Courses</p>
        </div>
    </div>

    <div class="col-md-4 col-lg-4">
        <div class="card shadow-sm border-1 text-center h-100 py-3">
            <h5 class="fw-bold mb-1"></h5>
            <p class="text-muted small mb-0">Total Payments</p>
        </div>
    </div>

    <div class="col-md-4 col-lg-4">
        <div class="card shadow-sm border-1 text-center h-100 py-3">
            <h5 class="fw-bold mb-1"></h5>
            <p class="text-muted small mb-0">Total Expenses</p>
        </div>
    </div>

    <div class="col-md-4 col-lg-4">
        <div class="card shadow-sm border-1 text-center h-100 py-3">
            <h5 class="fw-bold mb-1"></h5>
            <p class="text-muted small mb-0">Total Expenses</p>
        </div>
    </div>

    <div class="col-md-4 col-lg-4">
        <div class="card shadow-sm border-1 text-center h-100 py-3">
            <h5 class="fw-bold mb-1"></h5>
            <p class="text-muted small mb-0">Total Expenses</p>
        </div>
    </div>

</div>
        </div>
</x-layout>
