<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">➕ Add New Student</h4>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            ← Back to Student List
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf

                {{-- Organisation (Static Display)
                <div class="mb-3">
                    <label class="form-label fw-semibold">Organisation</label>
                    <input type="hidden" name="organisation_id" value="{{ $organisation->id }}">
                    <input type="text" class="form-control bg-light" value="{{ $organisation->name }}" readonly>
                </div> --}}

                {{-- Student Code --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Student Code <span class="text-danger">*</span></label>
                    <input type="text" name="student_code" class="form-control @error('student_code') is-invalid @enderror"
                        placeholder="Example: ST-001" value="{{ old('student_code') }}">
                    @error('student_code')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Basic Info --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                            value="{{ old('first_name') }}">
                        @error('first_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Last Name</label>
                        <input type="text" name="last_name" class="form-control"
                            value="{{ old('last_name') }}">
                    </div>
                </div>

                {{-- Contact Info --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                </div>

                {{-- Personal Info --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select</option>
                            @foreach(['male','female','other'] as $gender)
                                <option value="{{ $gender }}" {{ old('gender') == $gender ? 'selected' : '' }}>
                                    {{ ucfirst($gender) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Marital Status</label>
                        <select name="marital_status" class="form-select">
                            <option value="">Select</option>
                            @foreach(['single','married','divorced','widowed','separated'] as $status)
                                <option value="{{ $status }}" {{ old('marital_status') == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Parents Info --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Father’s Name</label>
                        <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Mother’s Name</label>
                        <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name') }}">
                    </div>
                </div>

                {{-- Spouse Info --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Spouse Name</label>
                    <input type="text" name="spouse_name" class="form-control" value="{{ old('spouse_name') }}">
                </div>

                {{-- Addresses --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Current Address</label>
                    <textarea name="current_address" class="form-control" rows="2">{{ old('current_address') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Permanent Address</label>
                    <textarea name="permanent_address" class="form-control" rows="2">{{ old('permanent_address') }}</textarea>
                </div>

                {{-- IDs --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Voter ID</label>
                        <input type="text" name="voter_id_card_no" class="form-control" value="{{ old('voter_id_card_no') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">PAN</label>
                        <input type="text" name="pan_card_no" class="form-control" value="{{ old('pan_card_no') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Aadhaar</label>
                        <input type="text" name="aadhar_no" class="form-control" value="{{ old('aadhar_no') }}">
                    </div>
                </div>

                {{-- Education --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Highest Qualification</label>
                        <select name="highest_qualification" class="form-select">
                            <option value="">Select</option>
                            @foreach(['matriculation','higher_secondary','graduation','masters','phd'] as $degree)
                                <option value="{{ $degree }}" {{ old('highest_qualification') == $degree ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('_',' ', $degree)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Joined On</label>
                        <input type="date" name="joined_on" class="form-control" value="{{ old('joined_on') }}">
                    </div>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select">
                        @foreach(['active','inactive','lead','alumni','withdrawn'] as $status)
                            <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">Save Student</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
