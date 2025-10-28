<x-layout>
    <div class="container mt-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Batch–Teacher Assignments</h4>
            <a href="{{ route('batch_teachers.create') }}" class="btn btn-primary">
                <i class="bi bi-person-plus"></i> Add Teacher
            </a>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Table --}}
        <div class="card shadow-sm">
            <div class="card-body">
                @if ($assignments->count())
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Batch</th>
                                <th>Teacher</th>
                                <th>Email</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignments as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->batch->title ?? '—' }}</td>
                                    <td>
                                        {{ trim("{$item->teacher->first_name} {$item->teacher->middle_name} {$item->teacher->last_name}") }}
                                    </td>
                                    <td>{{ $item->teacher->email ?? '—' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            {{-- Edit --}}
                                            <a href="{{ route('batch_teachers.edit', $item->id) }}" 
                                               class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('batch_teachers.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Remove this teacher from batch?');"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted mb-0">No teacher assignments found.</p>
                @endif
            </div>
        </div>

    </div>
</x-layout>
