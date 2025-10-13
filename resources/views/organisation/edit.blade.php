<x-layout>
    <h3>Edit Organisation</h3>

    <form method="POST" action="{{ route('organisation.update', $organisation->id) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $organisation->name }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $organisation->email }}">
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $organisation->phone }}">
        </div>
        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="{{ $organisation->address }}">
        </div>
        <div class="mb-3">
            <label>City</label>
            <input type="text" name="city" class="form-control" value="{{ $organisation->city }}">
        </div>
         <div class="mb-3">
            <label>State</label>
            <input type="text" name="state" class="form-control" value="{{ $organisation->state }}">
        </div>
         <div class="mb-3">
            <label>Postal Code</label>
            <input type="text" name="postal_code" class="form-control" value="{{ $organisation->postal_code }}">
        </div>
         <div class="mb-3">
            <label>Country</label>
            <input type="text" name="country" class="form-control" value="{{ $organisation->country }}">
        </div>
         <div class="mb-3">
            <label>Pan Number</label>
            <input type="text" name="pan_number" class="form-control" value="{{ $organisation->pan_number }}">
        </div>
         <div class="mb-3">
            <label>Gst Number</label>
            <input type="text" name="gstin_number" class="form-control" value="{{ $organisation->gstin_number }}">
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('organisation.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
