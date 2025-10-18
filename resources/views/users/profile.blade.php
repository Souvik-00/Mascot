<x-layout title="My Profile">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5>👤 Profile Details</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr><th>First Name:</th><td>{{ $user->first_name }}</td></tr>
                 <tr><th>Last Name:</th><td>{{ $user->last_name }}</td></tr>
                <tr><th>Email:</th><td>{{ $user->email }}</td></tr>
                <tr><th>Role:</th><td><span class="badge bg-info">{{ ucfirst($user->profile) }}</span></td></tr>
                <tr><th>Joined On:</th><td>{{ $user->created_at->format('d M Y') }}</td></tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">⬅️ Back to Dashboard</a>
            </div>
        </div>
    </div>
</x-layout>
