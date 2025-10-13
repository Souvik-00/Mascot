<x-layout>
    <h3>Add Organisation</h3>

    <form method="POST" action="{{ route('organisation.store') }}">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control">
        </div>
         <div class="mb-3">
            <label>City</label>
            <input type="text" name="city" class="form-control">
        </div>
         <div class="mb-3">
            <label>State</label>
            <input type="text" name="state" class="form-control">
        </div>
         <div class="mb-3">
            <label>Postal Code</label>
            <input type="text" name="postal_code" class="form-control">
        </div>
         <div class="mb-3">
            <label>Country</label>
            <input type="text" name="country" class="form-control">
        </div>
         <div class="mb-3">
            <label>Pan Number</label>
            <input type="text" name="pan_number" class="form-control">
        </div>
         <div class="mb-3">
            <label>Gst Number</label>
            <input type="text" name="gstin_number" class="form-control">
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('organisation.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
