<x-layout title="Add Meta Result">
    <h3 class="mb-4">➕ Add Meta Ad Result</h3>

    <form method="POST" action="{{ route('meta_results.store') }}">
        @csrf

        {{-- Date --}}
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        {{-- Link Clicks --}}
        <div class="mb-3">
            <label class="form-label">Link Clicks</label>
            <input type="text" name="link_clicks" class="form-control">
        </div>

        {{-- Cost per Link Clicks --}}
        <div class="mb-3">
            <label class="form-label">Cost per Link Click</label>
            <input type="text" name="cost_per_link_clicks" class="form-control">
        </div>

        {{-- Views --}}
        <div class="mb-3">
            <label class="form-label">Views</label>
            <input type="text" name="views" class="form-control">
        </div>

        {{-- Viewers --}}
        <div class="mb-3">
            <label class="form-label">Viewers</label>
            <input type="text" name="viewers" class="form-control">
        </div>

        {{-- Post Engagements --}}
        <div class="mb-3">
            <label class="form-label">Post Engagements</label>
            <input type="text" name="post_engagements" class="form-control">
        </div>

        {{-- 3-Second Video Plays --}}
        <div class="mb-3">
            <label class="form-label">3-Second Video Plays</label>
            <input type="text" name="three_second_video_plays" class="form-control">
        </div>

        {{-- Post Reactions --}}
        <div class="mb-3">
            <label class="form-label">Post Reactions</label>
            <input type="text" name="post_reactions" class="form-control">
        </div>

        {{-- Estimated Call Confirmation Clicks --}}
        <div class="mb-3">
            <label class="form-label">Estimated Call Confirmation Clicks</label>
            <input type="text" name="estimated_call_confirmation_clicks" class="form-control">
        </div>

        {{-- 20-Second Phone Calls --}}
        <div class="mb-3">
            <label class="form-label">20-Second Phone Calls</label>
            <input type="text" name="twenty_second_phone_calls" class="form-control">
        </div>

        {{-- Post Comments --}}
        <div class="mb-3">
            <label class="form-label">Post Comments</label>
            <input type="text" name="post_comments" class="form-control">
        </div>

        {{-- Post Shares --}}
        <div class="mb-3">
            <label class="form-label">Post Shares</label>
            <input type="text" name="post_shares" class="form-control">
        </div>

        {{-- Actual Call --}}
        <div class="mb-3">
            <label class="form-label">Actual Call</label>
            <input type="text" name="actual_call" class="form-control">
        </div>

        <button class="btn btn-primary w-100">Save Result</button>
    </form>
</x-layout>
