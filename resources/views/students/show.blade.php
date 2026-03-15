@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-6">
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

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th class="text-muted" style="width:35%">ID</th>
                        <td>#{{ $student->id }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Name</th>
                        <td class="fw-semibold">{{ $student->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Email</th>
                        <td>{{ $student->email }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Phone</th>
                        <td>{{ $student->phone ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Registered</th>
                        <td>{{ $student->created_at->format('M d, Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection