@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-6">
        <h4 class="fw-bold mb-4">Edit Student</h4>
        <div class="card shadow-sm p-4">
            <form action="{{ route('students.update', $student) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Full Name *</label>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $student->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email *</label>
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $student->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ old('phone', $student->phone) }}">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update Student</button>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection