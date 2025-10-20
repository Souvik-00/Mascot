<x-layout title="Add Marketing Source">
    <h3 class="mb-4">➕ Add New Marketing Source</h3>

    <form method="POST" action="{{ route('marketing_sources.store') }}">
        @csrf

        {{-- Lead Source --}}
        <div class="mb-3">
            <label class="form-label">Lead Source</label>
            <input 
                type="text" 
                name="lead_source" 
                value="{{ old('lead_source') }}" 
                class="form-control @error('lead_source') is-invalid @enderror" 
                placeholder="e.g., Meta Ads" 
                required
            >
            @error('lead_source')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary w-100">Save Source</button>
    </form>
</x-layout>
