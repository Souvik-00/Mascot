<x-layout>
    <h3>Edit Batch</h3>

    <form method="POST" action="{{ route('batches.update', $batch->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Organisation</label>
            <select name="organisation_id" class="form-control" required>
                @foreach($organisations as $org)
                    <option value="{{ $org->id }}" {{ $batch->organisation_id == $org->id ? 'selected' : '' }}>
                        {{ $org->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Batch Code</label>
                <input type="text" name="batch_code" class="form-control" value="{{ $batch->batch_code }}" required>
            </div>
            <div class="col-md-8 mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $batch->title }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ $batch->start_date }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ $batch->end_date }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>Capacity</label>
                <input type="number" name="capacity" class="form-control" value="{{ $batch->capacity }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                @foreach(['planned','running','completed','cancelled'] as $s)
                    <option value="{{ $s }}" {{ $batch->status == $s ? 'selected' : '' }}>
                        {{ ucfirst($s) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('batches.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
