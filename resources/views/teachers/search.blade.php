<x-layout title="Search Teachers">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>🔍 Search Results (Teachers)</h3>
        <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary">⬅ Back</a>
    </div>

    <form method="GET" action="{{ route('teachers.search') }}" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search again...">
        </div>
        <div class="col-md-2">
            <button class="btn btn-secondary w-100">Search</button>
        </div>
    </form>

    @if($teachers->isEmpty())
        <div class="alert alert-warning">No teachers found for “{{ $query }}”.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->id }}</td>
                            <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->phone ?? '—' }}</td>
                            <td>{{ ucfirst($teacher->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-layout>
