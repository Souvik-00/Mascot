<x-layout title="User Details">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>👤 User Details</h3>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">⬅ Back to Users</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $user->first_name }} {{ $user->last_name }}</h5>
            <p class="text-muted">Profile: <strong>{{ ucfirst($user->profile ?? 'N/A') }}</strong></p>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Phone:</strong> {{ $user->phone ?? '—' }}</p>
                    <p><strong>Gender:</strong> {{ ucfirst($user->gender ?? '—') }}</p>
                    <p><strong>DOB:</strong> {{ $user->dob ?? '—' }}</p>
                    <p><strong>Status:</strong>
                        <span class="badge bg-{{ $user->status == 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </p>
                    <p><strong>Joined At:</strong> {{ $user->joined_at ?? '—' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Father's Name:</strong> {{ $user->father_name ?? '—' }}</p>
                    <p><strong>Mother's Name:</strong> {{ $user->mother_name ?? '—' }}</p>
                    <p><strong>Marital Status:</strong> {{ ucfirst($user->marital_status ?? '—') }}</p>
                    <p><strong>Spouse Name:</strong> {{ $user->spouse_name ?? '—' }}</p>
                    <p><strong>Qualification:</strong> {{ ucwords(str_replace('_', ' ', $user->highest_qualification ?? '—')) }}</p>
                </div>
            </div>

            <hr>

            <h6 class="mt-3">Address</h6>
            <p><strong>Current Address:</strong> {{ $user->current_address ?? '—' }}</p>
            <p><strong>Permanent Address:</strong> {{ $user->permanent_address ?? '—' }}</p>

            <hr>

            <h6 class="mt-3">Identification</h6>
            <p><strong>Voter ID:</strong> {{ $user->voter_id_card_no ?? '—' }}</p>
            <p><strong>PAN Card:</strong> {{ $user->pan_card_no ?? '—' }}</p>
            <p><strong>Aadhar:</strong> {{ $user->aadhar_no ?? '—' }}</p>
            <p><strong>Encryption Key:</strong> <code>{{ $user->enc_key }}</code></p>

            <hr>

            <div class="d-flex justify-content-end">
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning me-2">✏️ Edit</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this user?')">🗑 Delete</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
