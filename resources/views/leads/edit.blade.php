<x-layout title="Edit Lead">
    <h3 class="mb-4">✏️ Edit Lead</h3>

    <form method="POST" action="{{ route('leads.update', $lead->id) }}">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" name="name" value="{{ old('name', $lead->name) }}" class="form-control @error('name') is-invalid @enderror" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Location --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Location</label>
            <textarea name="location" rows="2" class="form-control @error('location') is-invalid @enderror" required>{{ old('location', $lead->location) }}</textarea>
            @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Phone Number --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Phone Number</label>
            <input type="text" name="phone_number" value="{{ old('phone_number', $lead->phone_number) }}" class="form-control @error('phone_number') is-invalid @enderror" required>
            @error('phone_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Sex --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Sex</label>
            <select name="sex" class="form-control @error('sex') is-invalid @enderror" required>
                <option value="">-- Select --</option>
                <option value="male" {{ old('sex', $lead->sex) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('sex', $lead->sex) == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('sex', $lead->sex) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('sex') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Date of Contact --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Date of Contact</label>
            <input type="date" name="date_of_contact" value="{{ old('date_of_contact', $lead->date_of_contact) }}" class="form-control @error('date_of_contact') is-invalid @enderror" required>
            @error('date_of_contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Budget Range --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Budget Range (₹)</label>
            <input type="number" step="0.01" name="budget_range" value="{{ old('budget_range', $lead->budget_range) }}" class="form-control @error('budget_range') is-invalid @enderror" required>
            @error('budget_range') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Authority --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Authority</label>
            <select name="authority" class="form-control @error('authority') is-invalid @enderror" required>
                <option value="">-- Select --</option>
                <option value="Self" {{ old('authority', $lead->authority) == 'Self' ? 'selected' : '' }}>Self</option>
                <option value="Parent" {{ old('authority', $lead->authority) == 'Parent' ? 'selected' : '' }}>Parent</option>
                <option value="Others" {{ old('authority', $lead->authority) == 'Others' ? 'selected' : '' }}>Others - Specify</option>
            </select>
            @error('authority') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Need --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Need</label>
            <textarea name="need" rows="3" class="form-control @error('need') is-invalid @enderror" required>{{ old('need', $lead->need) }}</textarea>
            @error('need') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Timeline --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Timeline</label>
            <input type="text" name="timeline" value="{{ old('timeline', $lead->timeline) }}" class="form-control @error('timeline') is-invalid @enderror" placeholder="e.g., 1 Month, 3 Months" required>
            @error('timeline') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Marketing Source --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Marketing Source</label>
            <select name="marketing_source_id" class="form-control @error('marketing_source_id') is-invalid @enderror" required>
                <option value="">-- Select Source --</option>
                @foreach($sources as $source)
                    <option value="{{ $source->id }}" {{ old('marketing_source_id', $lead->marketing_source_id) == $source->id ? 'selected' : '' }}>
                        {{ $source->lead_source }}
                    </option>
                @endforeach
            </select>
            @error('marketing_source_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-success w-100">Update Lead</button>
    </form>
</x-layout>
