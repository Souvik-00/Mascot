<x-layout title="Leads">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>📋 Leads List</h3>
        <a href="{{ route('leads.create') }}" class="btn btn-primary">
            ➕ Add New Lead
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Leads Table --}}
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Phone</th>
                    <th>Sex</th>
                    <th>Date of Contact</th>
                    <th>Budget (₹)</th>
                    <th>Authority</th>
                    <th>Need</th>
                    <th>Timeline</th>
                    <th>Marketing Source</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($leads as $lead)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lead->name }}</td>
                        <td>{{ Str::limit($lead->location, 30) }}</td>
                        <td>{{ $lead->phone_number }}</td>
                        <td>{{ ucfirst($lead->sex) }}</td>
                        <td>{{ \Carbon\Carbon::parse($lead->date_of_contact)->format('d M Y') }}</td>
                        <td>{{ number_format($lead->budget_range, 2) }}</td>
                        <td>{{ $lead->authority }}</td>
                        <td>{{ Str::limit($lead->need, 40) }}</td>
                        <td>{{ $lead->timeline }}</td>
                        <td>
                            {{ $lead->marketingSource->lead_source ?? 'N/A' }}
                        </td>
                        <td class="text-end">
                            {{-- <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-sm btn-outline-info">👁️ View</a> --}}
                            <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-sm btn-outline-warning">✏️ Edit</a>
                            <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Delete this lead?')">
                                    🗑️ Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center text-muted">No leads found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $leads->links() }}
    </div>
</x-layout>
