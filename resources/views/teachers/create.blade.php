<x-layout>
    <h3>Add Teacher</h3>

    <form method="POST" action="{{ route('teachers.store') }}">
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
                <label>Teacher Code</label>
                <input type="text" name="teacher_code" value="{{ old('teacher_code') }}" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>Date of Birth</label>
                <input type="date" name="dob" value="{{ old('dob') }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Marital Status</label>
                <select name="marital_status" class="form-control">
                    <option value="">Select</option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                    <option value="widowed">Widowed</option>
                    <option value="separated">Separated</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Spouse Name</label>
                <input type="text" name="spouse_name" value="{{ old('spouse_name') }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Father’s Name</label>
                <input type="text" name="father_name" value="{{ old('father_name') }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Mother’s Name</label>
                <input type="text" name="mother_name" value="{{ old('mother_name') }}" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label>Current Address</label>
            <textarea name="current_address" class="form-control" rows="2">{{ old('current_address') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Permanent Address</label>
            <textarea name="permanent_address" class="form-control" rows="2">{{ old('permanent_address') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Voter ID</label>
                <input type="text" name="voter_id_card_no" value="{{ old('voter_id_card_no') }}" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>PAN</label>
                <input type="text" name="pan_card_no" value="{{ old('pan_card_no') }}" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>Aadhaar</label>
                <input type="text" name="aadhar_no" value="{{ old('aadhar_no') }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Highest Qualification</label>
                <select name="highest_qualification" class="form-control">
                    <option value="">Select</option>
                    <option value="matriculation">Matriculation</option>
                    <option value="higher_secondary">Higher Secondary</option>
                    <option value="graduation">Graduation</option>
                    <option value="masters">Masters</option>
                    <option value="phd">PhD</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>Specialization</label>
                <input type="text" name="specialization" value="{{ old('specialization') }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Joining Date</label>
                <input type="date" name="joined_on" value="{{ old('joined_on') }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="active" selected>Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
