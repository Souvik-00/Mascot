<x-layout>
    <h3>Edit Teacher</h3>

    <form method="POST" action="{{ route('teachers.update', $teacher->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Organisation</label>
            <select name="organisation_id" class="form-control" required>
                @foreach($organisations as $org)
                    <option value="{{ $org->id }}" {{ $teacher->organisation_id == $org->id ? 'selected' : '' }}>
                        {{ $org->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Teacher Code</label>
                <input type="text" name="teacher_code" value="{{ $teacher->teacher_code }}" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>First Name</label>
                <input type="text" name="first_name" value="{{ $teacher->first_name }}" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Last Name</label>
                <input type="text" name="last_name" value="{{ $teacher->last_name }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ $teacher->email }}" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ $teacher->phone }}" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>Date of Birth</label>
                <input type="date" name="dob" value="{{ $teacher->dob }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select</option>
                    @foreach(['male','female','other'] as $g)
                        <option value="{{ $g }}" {{ $teacher->gender == $g ? 'selected' : '' }}>{{ ucfirst($g) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Marital Status</label>
                <select name="marital_status" class="form-control">
                    <option value="">Select</option>
                    @foreach(['single','married','divorced','widowed','separated'] as $ms)
                        <option value="{{ $ms }}" {{ $teacher->marital_status == $ms ? 'selected' : '' }}>{{ ucfirst($ms) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Spouse Name</label>
                <input type="text" name="spouse_name" value="{{ $teacher->spouse_name }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Father’s Name</label>
                <input type="text" name="father_name" value="{{ $teacher->father_name }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Mother’s Name</label>
                <input type="text" name="mother_name" value="{{ $teacher->mother_name }}" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label>Current Address</label>
            <textarea name="current_address" class="form-control" rows="2">{{ $teacher->current_address }}</textarea>
        </div>

        <div class="mb-3">
            <label>Permanent Address</label>
            <textarea name="permanent_address" class="form-control" rows="2">{{ $teacher->permanent_address }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Voter ID</label>
                <input type="text" name="voter_id_card_no" value="{{ $teacher->voter_id_card_no }}" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>PAN</label>
                <input type="text" name="pan_card_no" value="{{ $teacher->pan_card_no }}" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>Aadhaar</label>
                <input type="text" name="aadhar_no" value="{{ $teacher->aadhar_no }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Highest Qualification</label>
                <select name="highest_qualification" class="form-control">
                    <option value="">Select</option>
                    @foreach(['matriculation','higher_secondary','graduation','masters','phd'] as $q)
                        <option value="{{ $q }}" {{ $teacher->highest_qualification == $q ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_',' ', $q)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>Specialization</label>
                <input type="text" name="specialization" value="{{ $teacher->specialization }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Joining Date</label>
                <input type="date" name="joined_on" value="{{ $teacher->joined_on }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="active" {{ $teacher->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $teacher->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
