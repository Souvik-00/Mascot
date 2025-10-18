<x-layout title="Meta Results">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>📊 Meta Ad Results</h3>
        <a href="{{ route('meta_results.create') }}" class="btn btn-primary">
            ➕ Add New Result
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Results Table --}}
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Link Clicks</th>
                    <th>Cost / Link Click</th>
                    <th>Views</th>
                    <th>Viewers</th>
                    <th>Post Engagements</th>
                    <th>3s Video Plays</th>
                    <th>Post Reactions</th>
                    <th>Call Conf. Clicks</th>
                    <th>20s Calls</th>
                    <th>Comments</th>
                    <th>Shares</th>
                    <th>Actual Call</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($results as $result)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $result->date }}</td>
                        <td>{{ $result->link_clicks }}</td>
                        <td>{{ $result->cost_per_link_clicks }}</td>
                        <td>{{ $result->views }}</td>
                        <td>{{ $result->viewers }}</td>
                        <td>{{ $result->post_engagements }}</td>
                        <td>{{ $result->three_second_video_plays }}</td>
                        <td>{{ $result->post_reactions }}</td>
                        <td>{{ $result->estimated_call_confirmation_clicks }}</td>
                        <td>{{ $result->twenty_second_phone_calls }}</td>
                        <td>{{ $result->post_comments }}</td>
                        <td>{{ $result->post_shares }}</td>
                        <td>{{ $result->actual_call }}</td>
                        <td class="text-end">
                            <a href="{{ route('meta_results.show', $result->id) }}" class="btn btn-sm btn-outline-info">View</a>
                            <a href="{{ route('meta_results.edit', $result->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="{{ route('meta_results.destroy', $result->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Delete this result?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="15" class="text-center text-muted">No Meta results found.</td>
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
