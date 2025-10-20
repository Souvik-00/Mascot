<x-layout title="Edit CRM Pipeline Stage">
    <h3 class="mb-4">✏️ Edit CRM Pipeline Stage</h3>

    <form method="POST" action="{{ route('crm_pipeline_stages.update', $crm_pipeline_stage->id) }}">
        @csrf
        @method('PUT')

        {{-- Stage Name --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Stage Name</label>
            <input 
                type="text" 
                name="crm_pipeline_stages" 
                value="{{ old('crm_pipeline_stages', $crm_pipeline_stage->crm_pipeline_stages) }}" 
                class="form-control @error('crm_pipeline_stages') is-invalid @enderror"
                placeholder="e.g., New Lead" 
                required
            >
            @error('crm_pipeline_stages')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- What It Means --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">What It Means</label>
            <textarea 
                name="what_it_means" 
                rows="3"
                class="form-control @error('what_it_means') is-invalid @enderror"
                placeholder="Describe what this stage represents"
                required>{{ old('what_it_means', $crm_pipeline_stage->what_it_means) }}</textarea>
            @error('what_it_means')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Enter When --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Enter When</label>
            <textarea 
                name="enter_when" 
                rows="2"
                class="form-control @error('enter_when') is-invalid @enderror"
                placeholder="Condition or event for entering this stage"
                required>{{ old('enter_when', $crm_pipeline_stage->enter_when) }}</textarea>
            @error('enter_when')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Exit When --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Exit When</label>
            <textarea 
                name="exit_when" 
                rows="2"
                class="form-control @error('exit_when') is-invalid @enderror"
                placeholder="Condition or event for exiting this stage"
                required>{{ old('exit_when', $crm_pipeline_stage->exit_when) }}</textarea>
            @error('exit_when')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Owner --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Owner</label>
            <textarea 
                name="owner" 
                rows="2"
                class="form-control @error('owner') is-invalid @enderror"
                placeholder="Who is responsible for this stage (e.g., Marketing Team)"
                required>{{ old('owner', $crm_pipeline_stage->owner) }}</textarea>
            @error('owner')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success w-100">Update Stage</button>
    </form>
</x-layout>
