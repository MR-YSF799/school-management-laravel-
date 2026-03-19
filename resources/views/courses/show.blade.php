@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Course Details</h4>
            <div class="d-flex gap-2">
                <a href="{{ route('courses.edit', $course) }}"
                   class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="{{ route('courses.destroy', $course) }}" method="POST"
                      onsubmit="return confirm('Are you sure?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
                <a href="{{ route('courses.index') }}"
                   class="btn btn-sm btn-outline-secondary">← Back</a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th class="text-muted" style="width:35%">ID</th>
                        <td>#{{ $course->id }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Title</th>
                        <td class="fw-semibold">{{ $course->title }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Description</th>
                        <td>{{ $course->description ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Credits</th>
                        <td><span class="badge bg-primary">{{ $course->credits }} credits</span></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Created</th>
                        <td>{{ $course->created_at->format('M d, Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Ajoute ceci en bas de la page, après le tableau des détails du cours --}}

<div class="mt-4">
    <h5 class="fw-bold mb-3">Enrolled Students ({{ $course->students->count() }})</h5>
    <div class="card shadow-sm">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Name</th><th>Email</th><th>Grade</th><th>Action</th></tr>
            </thead>
            <tbody>
                @forelse($course->students as $student)
                <tr>
                    <td class="fw-semibold">
                        <a href="{{ route('students.show', $student) }}" class="text-decoration-none">
                            {{ $student->name }}
                        </a>
                    </td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->pivot->grade ?? '—' }}</td>
                    <td>
                        <form action="{{ route('enrollments.destroy', $student->pivot->id) }}"
                              method="POST" onsubmit="return confirm('Remove?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-3">No students enrolled yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>

@endsection