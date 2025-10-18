<x-layout title="Create User">
    <h3 class="mb-4">👤 Create New User</h3>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        {{-- Basic Info --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" required>
            </div>
            <div class="col">
                <label class="form-label">Middle Name</label>
                <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="form-control">
            </div>
            <div class="col">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" required>
            </div>
        </div>

        {{-- Contact --}}
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
        </div>

        {{-- Password --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
        </div>

        {{-- Personal Info --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" value="{{ old('dob') }}" class="form-control">
            </div>
            <div class="col">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-control">
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
        </div>

        {{-- Parents & Marital --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Father's Name</label>
                <input type="text" name="father_name" value="{{ old('father_name') }}" class="form-control">
            </div>
            <div class="col">
                <label class="form-label">Mother's Name</label>
                <input type="text" name="mother_name" value="{{ old('mother_name') }}" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Marital Status</label>
                <select name="marital_status" class="form-control">
                    <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Single</option>
                    <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                    <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                    <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                    <option value="separated" {{ old('marital_status') == 'separated' ? 'selected' : '' }}>Separated</option>
                </select>
            </div>
            <div class="col">
                <label class="form-label">Spouse Name</label>
                <input type="text" name="spouse_name" value="{{ old('spouse_name') }}" class="form-control">
            </div>
        </div>

        {{-- Address --}}
        <div class="mb-3">
            <label class="form-label">Current Address</label>
            <textarea name="current_address" class="form-control" rows="2">{{ old('current_address') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Permanent Address</label>
            <textarea name="permanent_address" class="form-control" rows="2">{{ old('permanent_address') }}</textarea>
        </div>

        {{-- IDs --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Voter ID</label>
                <input type="text" name="voter_id_card_no" value="{{ old('voter_id_card_no') }}" class="form-control">
            </div>
            <div class="col">
                <label class="form-label">PAN Card No</label>
                <input type="text" name="pan_card_no" value="{{ old('pan_card_no') }}" class="form-control">
            </div>
            <div class="col">
                <label class="form-label">Aadhar No</label>
                <input type="text" name="aadhar_no" value="{{ old('aadhar_no') }}" class="form-control">
            </div>
        </div>

        {{-- Education & Employment --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Highest Qualification</label>
                <select name="highest_qualification" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="matriculation">Matriculation</option>
                    <option value="higher_secondary">Higher Secondary</option>
                    <option value="graduation">Graduation</option>
                    <option value="masters">Masters</option>
                    <option value="phd">PhD</option>
                </select>
            </div>
            <div class="col">
                <label class="form-label">Joined At</label>
                <input type="date" name="joined_at" value="{{ old('joined_at') }}" class="form-control">
            </div>
        </div>

        {{-- Role & Status --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Profile</label>
                <select name="profile" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <div class="col">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="lead">Lead</option>
                    <option value="alumni">Alumni</option>
                    <option value="withdrawn">Withdrawn</option>
                </select>
            </div>
        </div>

        {{-- Encryption Key --}}
        <div class="mb-3">
            <label class="form-label">Encryption Key (auto-generated if empty)</label>
            <input type="text" name="enc_key" value="{{ old('enc_key') }}" class="form-control">
        </div>

        {{-- Submit --}}
        <button class="btn btn-primary w-100">Create User</button>
    </form>
</x-layout>
