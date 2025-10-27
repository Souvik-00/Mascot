<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">🧪 Lead Trials</h4>
        {{-- You will trigger Add from Lead Conversion page, but adding general button too --}}
        <a href="#" class="btn btn-primary disabled">+ Add Lead Trial</a>
    </div>

    {{-- Manual Date Filter --}}
    <form action="{{ route('leads_trial.index') }}" method="GET" class="card p-3 shadow-sm border-0 mb-4">
     <div class="row">
        <div class="col-md-4">
            <label class="form-label fw-semibold">From Date</label>
            <input type="date" name="from_date" value="{{ request('from_date') }}" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">To Date</label>
            <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button class="btn btn-primary w-100 me-2">🔍 Search</button>

            @if(request('from_date') || request('to_date'))
                <a href="{{ route('leads_trial.index') }}" class="btn btn-secondary w-100">❌ Clear</a>
            @endif
        </div>
    </div>
    </form>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Lead</th>
                        <th>Course</th>
                        <th>Batch</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Comments</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trials as $trial)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $trial->lead->first_name }} {{ $trial->lead->last_name }}</td>
                            <td>{{ $trial->course->title }}</td>
                            <td>{{ $trial->batch->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($trial->trl_start_dt)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($trial->trl_end_dt)->format('d M Y') }}</td>
                            <td>{{ $trial->comments }}</td>
                            <td>
                                <a href="{{ route('leads_trial.edit', $trial->id) }}" class="btn btn-sm btn-warning">✏️</a>

                                <form action="{{ route('leads_trial.destroy', $trial->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this trial entry?')">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-3">
                                No Lead Trial records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $trials->links() }}
            </div>
        </div>
    </div>
</x-layout>
