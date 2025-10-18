<x-layout title="View Meta Result">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>📋 Meta Ad Result Details</h3>
        <a href="{{ route('meta_results.index') }}" class="btn btn-outline-secondary">⬅ Back</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Result for {{ \Carbon\Carbon::parse($metaResult->date)->format('d M Y') }}</h5>
            <hr>

            <div class="row mb-2">
                <div class="col-md-6"><strong>Link Clicks:</strong> {{ $metaResult->link_clicks ?? '—' }}</div>
                <div class="col-md-6"><strong>Cost per Link Click:</strong> {{ $metaResult->cost_per_link_clicks ?? '—' }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6"><strong>Views:</strong> {{ $metaResult->views ?? '—' }}</div>
                <div class="col-md-6"><strong>Viewers:</strong> {{ $metaResult->viewers ?? '—' }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6"><strong>Post Engagements:</strong> {{ $metaResult->post_engagements ?? '—' }}</div>
                <div class="col-md-6"><strong>3-Second Video Plays:</strong> {{ $metaResult->three_second_video_plays ?? '—' }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6"><strong>Post Reactions:</strong> {{ $metaResult->post_reactions ?? '—' }}</div>
                <div class="col-md-6"><strong>Estimated Call Confirmation Clicks:</strong> {{ $metaResult->estimated_call_confirmation_clicks ?? '—' }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6"><strong>20-Second Phone Calls:</strong> {{ $metaResult->twenty_second_phone_calls ?? '—' }}</div>
                <div class="col-md-6"><strong>Post Comments:</strong> {{ $metaResult->post_comments ?? '—' }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6"><strong>Post Shares:</strong> {{ $metaResult->post_shares ?? '—' }}</div>
                <div class="col-md-6"><strong>Actual Call:</strong> {{ $metaResult->actual_call ?? '—' }}</div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-end">
            <a href="{{ route('meta_results.edit', $metaResult->id) }}" class="btn btn-warning me-2">✏️ Edit</a>
            <form method="POST" action="{{ route('meta_results.destroy', $metaResult->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this record?')">🗑 Delete</button>
            </form>
        </div>
    </div>
</x-layout>
