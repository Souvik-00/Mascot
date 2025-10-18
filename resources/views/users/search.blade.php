<x-layout title="Search Users">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>🔍 Search Results</h3>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">⬅ Back to All Users</a>
    </div>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('users.search') }}" class="row mb-4">
        <div class="col-md-4">
            <input 
                type="text" 
                name="q" 
                value="{{ request('q') }}" 
                class="form-control" 
                placeholder="Search by name, email, phone, or enc key..."
            >
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-secondary w-100">Search</button>
        </div>
    </form>

    @if($users->isEmpty())
        <div class="alert alert-warning">
            No results found for "<strong>{{ request('q') }}</strong>".
        </div>
    @else
        <p class="text-muted mb-3">
            Showing results for "<strong>{{ request('q') }}</strong>":
        </p>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Profile</th>
                        <th>Status</th>
                        <th>Enc Key</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? '—' }}</td>
                            <td>{{ ucfirst($user->profile ?? '—') }}</td>
                            <td>
                                <span class="badge bg-{{ $user->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td><code>{{ Str::limit($user->enc_key, 8, '...') }}</code></td>
                            <td class="text-end">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-info">View</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-layout>
