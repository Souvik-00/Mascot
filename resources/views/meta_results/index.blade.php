<x-layout title="Meta Results">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>📊 Meta Ad Results</h3>
        <a href="{{ route('meta_results.create') }}" class="btn btn-primary">
            ➕ Add New Result
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Meta Results Table --}}
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Link Clicks</th>
                    <th>Cost / Click</th>
                    <th>Views</th>
                    <th>Viewers</th>
                    <th>Post Engagements</th>
                    <th>3s Video Plays</th>
                    <th>Reactions</th>
                    <th>Est. Call Clicks</th>
                    <th>20s Calls</th>
                    <th>Comments</th>
                    <th>Shares</th>
                    <th>Actual Calls</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody class="text-center">
                @forelse($results as $result)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($result->date)->format('d M Y') }}</td>
                        <td>{{ number_format($result->link_clicks, 2) }}</td>
                        <td>{{ number_format($result->cost_per_link_clicks, 2) }}</td>
                        <td>{{ number_format($result->views, 2) }}</td>
                        <td>{{ number_format($result->viewers, 2) }}</td>
                        <td>{{ number_format($result->post_engagements, 2) }}</td>
                        <td>{{ number_format($result->three_second_video_plays, 2) }}</td>
                        <td>{{ number_format($result->post_reactions, 2) }}</td>
                        <td>{{ number_format($result->estimated_call_confirmation_clicks, 2) }}</td>
                        <td>{{ number_format($result->twenty_second_phone_calls, 2) }}</td>
                        <td>{{ number_format($result->post_comments, 2) }}</td>
                        <td>{{ number_format($result->post_shares, 2) }}</td>
                        <td>{{ number_format($result->actual_call, 2) }}</td>
                        <td class="text-end">
                            <a href="{{ route('meta_results.show', $result->id) }}" class="btn btn-sm btn-outline-info">👁️ View</a>
                            <a href="{{ route('meta_results.edit', $result->id) }}" class="btn btn-sm btn-outline-warning">✏️ Edit</a>
                            <form action="{{ route('meta_results.destroy', $result->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Delete this record?')">
                                    🗑️ Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="15" class="text-center text-muted">No Meta Results found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $results->links() }}
    </div>
</x-layout>
