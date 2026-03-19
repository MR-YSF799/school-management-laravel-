@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-6">
        <h4 class="fw-bold mb-4">Enroll Student in a Course</h4>

        <div class="card shadow-sm p-4 mb-3">
            <p class="mb-0 text-muted">Student</p>
            <p class="fw-bold fs-5 mb-0">{{ $student->name }}</p>
        </div>

        <div class="card shadow-sm p-4">
            <form action="{{ route('enrollments.store') }}" method="POST">
                @csrf

                <input type="hidden" name="student_id" value="{{ $student->id }}">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Select Course *</label>
                    <select name="course_id"
                            class="form-select @error('course_id') is-invalid @enderror">
                        <option value="">-- Choose a course --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->title }} ({{ $course->credits }} credits)
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if($courses->isEmpty())
                        <div class="form-text text-warning">
                            This student is already enrolled in all available courses.
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Grade (optional)</label>
                    <input type="number" name="grade" min="0" max="20" step="0.25"
                           class="form-control @error('grade') is-invalid @enderror"
                           value="{{ old('grade') }}" placeholder="e.g. 15.5">
                    @error('grade')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success"
                            {{ $courses->isEmpty() ? 'disabled' : '' }}>
                        Confirm Enrollment
                    </button>
                    <a href="{{ route('students.show', $student) }}"
                       class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection