@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-8">

        {{-- En-tête profil --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Student Profile</h4>
            <div class="d-flex gap-2">
                <a href="{{ route('students.edit', $student) }}"
                   class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="{{ route('students.destroy', $student) }}" method="POST"
                      onsubmit="return confirm('Are you sure?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
                <a href="{{ route('students.index') }}"
                   class="btn btn-sm btn-outline-secondary">← Back</a>
            </div>
        </div>

        {{-- Informations de l'étudiant --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr><th class="text-muted" style="width:30%">ID</th><td>#{{ $student->id }}</td></tr>
                    <tr><th class="text-muted">Name</th><td class="fw-semibold">{{ $student->name }}</td></tr>
                    <tr><th class="text-muted">Email</th><td>{{ $student->email }}</td></tr>
                    <tr><th class="text-muted">Phone</th><td>{{ $student->phone ?? '—' }}</td></tr>
                    <tr><th class="text-muted">Registered</th><td>{{ $student->created_at->format('M d, Y') }}</td></tr>
                </table>
            </div>
        </div>

        {{-- Cours inscrits --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Enrolled Courses</h5>
            <a href="{{ route('enrollments.create', $student) }}"
               class="btn btn-sm btn-success">+ Enroll in Course</a>
        </div>

        <div class="card shadow-sm">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Course</th>
                        <th>Credits</th>
                        <th>Grade</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($student->courses as $course)
                    <tr>
                        <td class="fw-semibold">{{ $course->title }}</td>
                        <td><span class="badge bg-primary">{{ $course->credits }} cr</span></td>
                        <td>
                            {{-- Formulaire inline pour modifier la note --}}
                            <form action="{{ route('enrollments.update', $course->pivot->id) }}"
                                  method="POST" class="d-flex gap-1 align-items-center">
                                @csrf @method('PUT')
                                <input type="number" name="grade" min="0" max="20" step="0.25"
                                       class="form-control form-control-sm" style="width:80px"
                                       value="{{ $course->pivot->grade ?? '' }}"
                                       placeholder="—">
                                <button class="btn btn-sm btn-outline-secondary">Save</button>
                            </form>
                        </td>
                        <td>
                            {{-- Supprimer l'inscription --}}
                            <form action="{{ route('enrollments.destroy', $course->pivot->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Remove this enrollment?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">
                            Not enrolled in any course yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection