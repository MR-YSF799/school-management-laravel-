@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">All Students</h4>
    <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">+ Add Student</a>
</div>

<div class="card shadow-sm">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td class="fw-semibold">{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->phone ?? '—' }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('students.show', $student) }}"
                       class="btn btn-sm btn-outline-secondary">View</a>
                    <a href="{{ route('students.edit', $student) }}"
                       class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="{{ route('students.destroy', $student) }}" method="POST"
                          onsubmit="return confirm('Delete this student?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">No students yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $students->links() }}</div>

@endsection