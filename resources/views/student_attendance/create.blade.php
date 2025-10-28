<x-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Mark Student Attendance</h4>
            <a href="{{ route('student_attendance.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        {{-- Flash & Errors --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('student_attendance.store') }}" method="POST">
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
                    <h6 class="fw-bold mb-3">Students</h6>
                    <div id="studentsContainer">
                        <p class="text-muted">Select a batch to load students...</p>
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
            const container = document.getElementById('studentsContainer');
            container.innerHTML = '<p class="text-muted">Loading students...</p>';

            if (batchId) {
                const response = await fetch(`/student-attendance/get-students/${batchId}`);
                const students = await response.json();

                if (students.length === 0) {
                    container.innerHTML = '<p class="text-danger">No students found in this batch.</p>';
                    return;
                }

                let html = '<table class="table table-bordered"><thead><tr><th>Student Name</th><th>Present</th><th>Absent</th></tr></thead><tbody>';
                students.forEach(student => {
                    html += `
                        <tr>
                            <td>${student.first_name} ${student.last_name}</td>
                            <td><input type="radio" name="attendance[${student.id}]" value="1"></td>
                            <td><input type="radio" name="attendance[${student.id}]" value="0" checked></td>
                        </tr>`;
                });
                html += '</tbody></table>';
                container.innerHTML = html;
            }
        });
    </script>
</x-layout>
