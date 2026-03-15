<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Show all students
    public function index()
    {
        $students = Student::latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    // Show create form
    public function create()
    {
        return view('students.create');
    }

    // Save new student
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'phone' => 'nullable|string|max:20',
        ]);

        Student::create($request->only('name', 'email', 'phone'));

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    // Show one student
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // Show edit form
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update student
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $student->update($request->only('name', 'email', 'phone'));

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    // Delete student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')
            ->with('success', 'Student deleted.');
    }
}