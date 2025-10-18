<x-layout title="All Users">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>👥 All Users</h3>
        <a href="{{ route('users.create') }}" class="btn btn-primary">➕ Create New User</a>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('users.search') }}" class="row mb-4">
        <div class="col-md-4">
            <input 
                type="text" 
                name="q" 
                class="form-control" 
                placeholder="Search by name, email, or phone..."
            >
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-secondary w-100">Search</button>
        </div>
    </form>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Users Table --}}
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
                    <th>Joined</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
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
                        <td>{{ $user->joined_at ?? '—' }}</td>
                        <td class="text-end">
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-info">View</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
</x-layout>
