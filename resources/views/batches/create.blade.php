<x-layout>
    <h3>Add Batch</h3>

    <form method="POST" action="{{ route('batches.store') }}">
        @csrf

        <div class="mb-3">
            <label>Organisation</label>
            <select name="organisation_id" class="form-control" required>
                <option value="">Select Organisation</option>
                @foreach($organisations as $org)
                    <option value="{{ $org->id }}">{{ $org->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Batch Code</label>
                <input type="text" name="batch_code" class="form-control" value="{{ old('batch_code') }}" required>
            </div>
            <div class="col-md-8 mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>Capacity</label>
                <input type="number" name="capacity" class="form-control" value="{{ old('capacity') }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="planned">Planned</option>
                <option value="running">Running</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('batches.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
