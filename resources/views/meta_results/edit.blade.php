<x-layout title="Edit Meta Result">
    <h3 class="mb-4">✏️ Edit Meta Ad Result</h3>

    <form method="POST" action="{{ route('meta_results.update', $metaResult->id) }}">
        @csrf
        @method('PUT')

        {{-- Date --}}
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" value="{{ old('date', $metaResult->date) }}" class="form-control" required>
        </div>

        {{-- Link Clicks --}}
        <div class="mb-3">
            <label class="form-label">Link Clicks</label>
            <input type="text" name="link_clicks" value="{{ old('link_clicks', $metaResult->link_clicks) }}" class="form-control">
        </div>

        {{-- Cost per Link Click --}}
        <div class="mb-3">
            <label class="form-label">Cost per Link Click</label>
            <input type="text" name="cost_per_link_clicks" value="{{ old('cost_per_link_clicks', $metaResult->cost_per_link_clicks) }}" class="form-control">
        </div>

        {{-- Views --}}
        <div class="mb-3">
            <label class="form-label">Views</label>
            <input type="text" name="views" value="{{ old('views', $metaResult->views) }}" class="form-control">
        </div>

        {{-- Viewers --}}
        <div class="mb-3">
            <label class="form-label">Viewers</label>
            <input type="text" name="viewers" value="{{ old('viewers', $metaResult->viewers) }}" class="form-control">
        </div>

        {{-- Post Engagements --}}
        <div class="mb-3">
            <label class="form-label">Post Engagements</label>
            <input type="text" name="post_engagements" value="{{ old('post_engagements', $metaResult->post_engagements) }}" class="form-control">
        </div>

        {{-- 3-Second Video Plays --}}
        <div class="mb-3">
            <label class="form-label">3-Second Video Plays</label>
            <input type="text" name="three_second_video_plays" value="{{ old('three_second_video_plays', $metaResult->three_second_video_plays) }}" class="form-control">
        </div>

        {{-- Post Reactions --}}
        <div class="mb-3">
            <label class="form-label">Post Reactions</label>
            <input type="text" name="post_reactions" value="{{ old('post_reactions', $metaResult->post_reactions) }}" class="form-control">
        </div>

        {{-- Estimated Call Confirmation Clicks --}}
        <div class="mb-3">
            <label class="form-label">Estimated Call Confirmation Clicks</label>
            <input type="text" name="estimated_call_confirmation_clicks" value="{{ old('estimated_call_confirmation_clicks', $metaResult->estimated_call_confirmation_clicks) }}" class="form-control">
        </div>

        {{-- 20-Second Phone Calls --}}
        <div class="mb-3">
            <label class="form-label">20-Second Phone Calls</label>
            <input type="text" name="twenty_second_phone_calls" value="{{ old('twenty_second_phone_calls', $metaResult->twenty_second_phone_calls) }}" class="form-control">
        </div>

        {{-- Post Comments --}}
        <div class="mb-3">
            <label class="form-label">Post Comments</label>
            <input type="text" name="post_comments" value="{{ old('post_comments', $metaResult->post_comments) }}" class="form-control">
        </div>

        {{-- Post Shares --}}
        <div class="mb-3">
            <label class="form-label">Post Shares</label>
            <input type="text" name="post_shares" value="{{ old('post_shares', $metaResult->post_shares) }}" class="form-control">
        </div>

        {{-- Actual Call --}}
        <div class="mb-3">
            <label class="form-label">Actual Call</label>
            <input type="text" name="actual_call" value="{{ old('actual_call', $metaResult->actual_call) }}" class="form-control">
        </div>

        <button class="btn btn-success w-100">Update Result</button>
    </form>
</x-layout>
