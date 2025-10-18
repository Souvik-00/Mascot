<x-layout title="Edit User">
    <h3 class="mb-4">✏️ Edit User</h3>

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        {{-- Basic Info --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="form-control" required>
            </div>
            <div class="col">
                <label class="form-label">Middle Name</label>
                <input type="text" name="middle_name" value="{{ old('middle_name', $user->middle_name) }}" class="form-control">
            </div>
            <div class="col">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="form-control" required>
            </div>
        </div>

        {{-- Contact --}}
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
        </div>

        {{-- Password --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">New Password</label>
                <input type="password" name="password" class="form-control">
                <small class="text-muted">Leave blank to keep the current password.</small>
            </div>
            <div class="col">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
        </div>

        {{-- Personal Info --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" value="{{ old('dob', $user->dob) }}" class="form-control">
            </div>
            <div class="col">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-control">
                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
        </div>

        {{-- Parents & Marital --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Father's Name</label>
                <input type="text" name="father_name" value="{{ old('father_name', $user->father_name) }}" class="form-control">
            </div>
            <div class="col">
                <label class="form-label">Mother's Name</label>
                <input type="text" name="mother_name" value="{{ old('mother_name', $user->mother_name) }}" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Marital Status</label>
                <select name="marital_status" class="form-control">
                    @foreach(['single', 'married', 'divorced', 'widowed', 'separated'] as $status)
                        <option value="{{ $status }}" {{ $user->marital_status == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label class="form-label">Spouse Name</label>
                <input type="text" name="spouse_name" value="{{ old('spouse_name', $user->spouse_name) }}" class="form-control">
            </div>
        </div>

        {{-- Address --}}
        <div class="mb-3">
            <label class="form-label">Current Address</label>
            <textarea name="current_address" class="form-control">{{ old('current_address', $user->current_address) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Permanent Address</label>
            <textarea name="permanent_address" class="form-control">{{ old('permanent_address', $user->permanent_address) }}</textarea>
        </div>

        {{-- IDs --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Voter ID</label>
                <input type="text" name="voter_id_card_no" value="{{ old('voter_id_card_no', $user->voter_id_card_no) }}" class="form-control">
            </div>
            <div class="col">
                <label class="form-label">PAN Card No</label>
                <input type="text" name="pan_card_no" value="{{ old('pan_card_no', $user->pan_card_no) }}" class="form-control">
            </div>
            <div class="col">
                <label class="form-label">Aadhar No</label>
                <input type="text" name="aadhar_no" value="{{ old('aadhar_no', $user->aadhar_no) }}" class="form-control">
            </div>
        </div>

        {{-- Education & Employment --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Highest Qualification</label>
                <select name="highest_qualification" class="form-control">
                    @foreach(['matriculation', 'higher_secondary', 'graduation', 'masters', 'phd'] as $q)
                        <option value="{{ $q }}" {{ $user->highest_qualification == $q ? 'selected' : '' }}>
                            {{ ucwords(str_replace('_', ' ', $q)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label class="form-label">Joined At</label>
                <input type="date" name="joined_at" value="{{ old('joined_at', $user->joined_at) }}" class="form-control">
            </div>
        </div>

        {{-- Profile & Status --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Profile</label>
                <select name="profile" class="form-control">
                    @foreach(['student', 'teacher', 'admin', 'staff'] as $p)
                        <option value="{{ $p }}" {{ $user->profile == $p ? 'selected' : '' }}>
                            {{ ucfirst($p) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    @foreach(['active', 'inactive', 'lead', 'alumni', 'withdrawn'] as $s)
                        <option value="{{ $s }}" {{ $user->status == $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Encryption Key --}}
        <div class="mb-3">
            <label class="form-label">Encryption Key</label>
            <input type="text" name="enc_key" value="{{ old('enc_key', $user->enc_key) }}" class="form-control">
        </div>

        <button class="btn btn-success w-100">Update User</button>
    </form>
</x-layout>
