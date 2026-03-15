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
    </div>
</div>

@endsection