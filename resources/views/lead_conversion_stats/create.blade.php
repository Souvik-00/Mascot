<x-layout title="Add Lead Conversion Record">
    <h3 class="mb-4">➕ Add New Lead Conversion Record</h3>

    <form method="POST" action="{{ route('lead_conversion_stats.store') }}">
        @csrf

        {{-- Lead --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Lead</label>
            <select name="leads_id" class="form-control @error('leads_id') is-invalid @enderror" required>
                <option value="">-- Select Lead --</option>
                @foreach($leads as $lead)
                    <option value="{{ $lead->id }}" {{ old('leads_id') == $lead->id ? 'selected' : '' }}>
                        {{ $lead->name }}
                    </option>
                @endforeach
            </select>
            @error('leads_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Date --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Date</label>
            <input 
                type="date" 
                name="date" 
                value="{{ old('date') }}" 
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
                    <option value="{{ $stage->id }}" {{ old('crm_pipeline_stages_id') == $stage->id ? 'selected' : '' }}>
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
                placeholder="Add remarks or details" 
                required>{{ old('comments') }}</textarea>
            @error('comments') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-primary w-100">Save Record</button>
    </form>
</x-layout>
