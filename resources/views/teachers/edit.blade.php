<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">✏️ Edit Teacher — {{ $teacher->teacher_code }}</h4>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">Organisation</label>
                    <input type="hidden" name="organisation_id" value="{{ $organisation->id }}">
                    <input type="text" class="form-control bg-light" value="{{ $organisation->name }}" readonly>
                </div> --}}

                <div class="mb-3">
                    <label class="form-label fw-semibold">Teacher Code *</label>
                    <input type="text" name="teacher_code" class="form-control" value="{{ old('teacher_code', $teacher->teacher_code) }}">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">First Name *</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $teacher->first_name) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $teacher->last_name) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $teacher->email) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $teacher->phone) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">DOB</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob', $teacher->dob) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select</option>
                            @foreach(['male','female','other'] as $g)
                                <option value="{{ $g }}" {{ old('gender', $teacher->gender) == $g ? 'selected' : '' }}>{{ ucfirst($g) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Marital Status</label>
                        <select name="marital_status" class="form-select">
                            <option value="">Select</option>
                            @foreach(['single','married','divorced','widowed','separated'] as $m)
                                <option value="{{ $m }}" {{ old('marital_status', $teacher->marital_status) == $m ? 'selected' : '' }}>{{ ucfirst($m) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Highest Qualification</label>
                        <select name="highest_qualification" class="form-select">
                            @foreach(['matriculation','higher_secondary','graduation','masters','phd'] as $q)
                                <option value="{{ $q }}" {{ old('highest_qualification', $teacher->highest_qualification) == $q ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('_',' ',$q)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Specialization</label>
                        <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $teacher->specialization) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Joined On</label>
                        <input type="date" name="joined_on" class="form-control" value="{{ old('joined_on', $teacher->joined_on) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Status *</label>
                        <select name="status" class="form-select">
                            @foreach(['active','inactive'] as $s)
                                <option value="{{ $s }}" {{ old('status', $teacher->status) == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">💾 Update Teacher</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>