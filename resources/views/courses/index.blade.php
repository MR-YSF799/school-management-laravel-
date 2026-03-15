@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">All Courses</h4>
    <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm">+ Add Course</a>
</div>

<div class="card shadow-sm">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Credits</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td class="fw-semibold">{{ $course->title }}</td>
                <td class="text-muted">{{ Str::limit($course->description, 50) ?? '—' }}</td>
                <td><span class="badge bg-primary">{{ $course->credits }} cr</span></td>
                <td class="d-flex gap-2">
                    <a href="{{ route('courses.show', $course) }}"
                       class="btn btn-sm btn-outline-secondary">View</a>
                    <a href="{{ route('courses.edit', $course) }}"
                       class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="{{ route('courses.destroy', $course) }}" method="POST"
                          onsubmit="return confirm('Delete this course?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">No courses yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $courses->links() }}</div>

@endsection