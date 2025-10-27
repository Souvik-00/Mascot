<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">📋 Mark Lead Attendance</h4>
        <a href="{{ route('leads_attendance.index') }}" class="btn btn-secondary">← History</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Date selector --}}
    <form method="GET" action="{{ route('leads_attendance.mark') }}" class="card p-3 shadow-sm border-0 mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Date</label>
                <input type="date" name="date" value="{{ $date }}" class="form-control">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary w-100">🔄 Load</button>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ route('leads_attendance.store') }}" class="card shadow-sm border-0">
        @csrf
        <input type="hidden" name="attn_date" value="{{ $date }}">

        <div class="card-body table-responsive">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="fw-semibold">Date: {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</div>
                <div class="d-flex gap-2">
                    <button type="button" id="markAllPresent" class="btn btn-outline-success btn-sm">Mark All Present</button>
                    <button type="button" id="markAllAbsent" class="btn btn-outline-danger btn-sm">Mark All Absent</button>
                </div>
            </div>

            <table class="table table-striped align-middle">
                <thead class="table-dark">
                <tr>
                    <th style="width:60px">#</th>
                    <th>Lead</th>
                    <th class="text-center" style="width:140px">Present</th>
                    <th class="text-center" style="width:140px">Absent</th>
                </tr>
                </thead>
                <tbody>
                @forelse($leads as $i => $lead)
                    @php
                        $existing = $attendance->get($lead->id);
                        $present = $existing && $existing->status === 'present';
                        $absent  = $existing && $existing->status === 'absent';
                    @endphp

                    {{-- Keep track of ids rendered (used to mark blanks as absent) --}}
                    <input type="hidden" name="included_lead_ids[]" value="{{ $lead->id }}"/>

                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $lead->name }}</td>
                        <td class="text-center">
                            <input type="radio"
                                   name="attendance[{{ $lead->id }}]"
                                   value="present"
                                   class="form-check-input present-radio"
                                   {{ $present ? 'checked' : '' }}>
                        </td>
                        <td class="text-center">
                            <input type="radio"
                                   name="attendance[{{ $lead->id }}]"
                                   value="absent"
                                   class="form-check-input absent-radio"
                                   {{ $absent ? 'checked' : '' }}>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">No leads found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="text-end">
                <button class="btn btn-primary px-4">💾 Save Attendance</button>
            </div>
        </div>
    </form>

    <script>
        document.getElementById('markAllPresent').addEventListener('click', () => {
            document.querySelectorAll('.present-radio').forEach(i => i.checked = true);
        });
        document.getElementById('markAllAbsent').addEventListener('click', () => {
            document.querySelectorAll('.absent-radio').forEach(i => i.checked = true);
        });
    </script>
</x-layout>
