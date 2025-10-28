<x-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Mark Lead Attendance</h4>
            <a href="{{ route('lead_attendance.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
        @if($errors->any())
            <div class="alert alert-danger"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('lead_attendance.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Select Batch</label>
                            <select id="batchSelect" name="batch_id" class="form-select" required>
                                <option value="">-- Select Batch --</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Attendance Date</label>
                            <input type="date" name="attendance_date" class="form-control" required>
                        </div>
                    </div>

                    <hr>
                    <h6 class="fw-bold mb-3">Leads</h6>
                    <div id="leadsContainer">
                        <p class="text-muted">Select a batch to load leads...</p>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="bi bi-save"></i> Save Attendance
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('batchSelect').addEventListener('change', async function () {
            const batchId = this.value;
            const container = document.getElementById('leadsContainer');
            container.innerHTML = '<p class="text-muted">Loading leads...</p>';

            if (batchId) {
                const response = await fetch(`/lead-attendance/get-leads/${batchId}`);
                const leads = await response.json();

                if (leads.length === 0) {
                    container.innerHTML = '<p class="text-danger">No leads assigned to this batch.</p>';
                    return;
                }

                let html = '<table class="table table-bordered"><thead><tr><th>Lead Name</th><th>Present</th><th>Absent</th></tr></thead><tbody>';
                leads.forEach(lead => {
                    html += `
                        <tr>
                            <td>${lead.name}</td>
                            <td><input type="radio" name="attendance[${lead.id}]" value="1"></td>
                            <td><input type="radio" name="attendance[${lead.id}]" value="0" checked></td>
                        </tr>`;
                });
                html += '</tbody></table>';
                container.innerHTML = html;
            }
        });
    </script>
</x-layout>
