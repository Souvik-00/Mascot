<x-layout title="Edit Lead Conversion Record">
    <h3 class="mb-4">✏️ Add New Version for Lead</h3>

    <form method="POST" action="{{ route('lead_conversion_stats.update', $lead_conversion_stat->id) }}">
        @csrf
        @method('PUT')

        {{-- Lead (Locked) --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Lead</label>
            <input 
                type="text" 
                class="form-control" 
                value="{{ $lead_conversion_stat->lead->name ?? 'N/A' }}" 
                disabled>
            <input type="hidden" name="leads_id" value="{{ $lead_conversion_stat->leads_id }}">
        </div>

        {{-- Date --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Date</label>
            <input 
                type="date" 
                name="date" 
                value="{{ old('date', $lead_conversion_stat->date) }}" 
                class="form-control @error('date') is-invalid @enderror" 
                required>
            @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- CRM Pipeline Stage --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">CRM Pipeline Stage</label>
            <select name="crm_pipeline_stages_id" class="form-control @error('crm_pipeline_stages_id') is-invalid @enderror" required>
                <option value="">-- Select Stage --</option>
                @foreach($stages as $stage)
                    <option value="{{ $stage->id }}" {{ old('crm_pipeline_stages_id', $lead_conversion_stat->crm_pipeline_stages_id) == $stage->id ? 'selected' : '' }}>
                        {{ $stage->crm_pipeline_stages }}
                    </option>
                @endforeach
            </select>
            @error('crm_pipeline_stages_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Comments --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Comments</label>
            <textarea 
                name="comments" 
                rows="3" 
                class="form-control @error('comments') is-invalid @enderror" 
                required>{{ old('comments', $lead_conversion_stat->comments) }}</textarea>
            @error('comments') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        {{-- <p>{{ session('crm_pipeline_stages_id') }}</p> --}}

        <button class="btn btn-success w-100">💾 Save as New Version</button>
    </form>
</x-layout>
