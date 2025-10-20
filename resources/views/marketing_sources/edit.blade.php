<x-layout title="Edit Marketing Source">
    <h3 class="mb-4">✏️ Edit Marketing Source</h3>

    <form method="POST" action="{{ route('marketing_sources.update', $marketing_source->id) }}">
        @csrf
        @method('PUT')

        {{-- Lead Source --}}
        <div class="mb-3">
            <label class="form-label">Lead Source</label>
            <input 
                type="text" 
                name="lead_source" 
                value="{{ old('lead_source', $marketing_source->lead_source) }}" 
                class="form-control @error('lead_source') is-invalid @enderror" 
                placeholder="e.g., Meta Ads" 
                required
            >
            @error('lead_source')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success w-100">Update Source</button>
    </form>
</x-layout>
