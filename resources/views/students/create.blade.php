@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-6">
        <h4 class="fw-bold mb-4">Add New Student</h4>
        <div class="card shadow-sm p-4">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Full Name *</label>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" placeholder="e.g. Amina Moussaoui">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email *</label>
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="e.g. amina@example.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ old('phone') }}" placeholder="Optional">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Save Student</button>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection