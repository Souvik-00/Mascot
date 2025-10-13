<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Organisations</h3>
        <a href="{{ route('organisation.create') }}" class="btn btn-primary">Add Organisation</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Postal Code</th>
                <th>Country</th>
                <th>Pan Number</th>
                <th>Gst Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($organisation as $org)
                <tr>
                    <td>{{ $org->id }}</td>
                    <td>{{ $org->name }}</td>
                    <td>{{ $org->email }}</td>
                    <td>{{ $org->phone }}</td>
                    <td>{{ $org->address }}</td>
                    <td>{{ $org->city }}</td>
                    <td>{{ $org->state }}</td>
                    <td>{{ $org->postal_code }}</td>
                    <td>{{ $org->country }}</td>
                    <td>{{ $org->pan_number }}</td>
                    <td>{{ $org->gstin_number }}</td>
                    <td>
                        <a href="{{ route('organisation.edit', $org->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('organisation.destroy', $org->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="12" class="text-center">No organisations found.</td></tr>
            @endforelse
        </tbody>
    </table>
</x-layout>
