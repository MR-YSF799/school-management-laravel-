<?php

namespace App\Http\Controllers;

use App\Models\Course; // Import the Course model
use Illuminate\Http\Request; // Import Request for handling form data

class CourseController extends Controller
{

    // Display a list of courses
    public function index()
    {
        // Get courses ordered by latest created and paginate them (10 per page)
        $courses = Course::latest()->paginate(10);

        // Return the courses.index view and pass the courses variable
        return view('courses.index', compact('courses'));
    }

    // Show the form to create a new course
    public function create()
    {
        // Return the view containing the creation form
        return view('courses.create');
    }

    // Store a new course in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title'       => 'required|string|max:255', // Title must exist and be a string
            'description' => 'nullable|string', // Description is optional
            'credits'     => 'required|integer|min:1|max:10', // Credits must be between 1 and 10
        ]);

        // Create a new course using only the allowed fields
        Course::create($request->only('title', 'description', 'credits'));

        // Redirect to the courses list with a success message
        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully.');
    }

    // Display a specific course
    public function show(Course $course)
    {
        // Laravel automatically retrieves the course using Route Model Binding
        return view('courses.show', compact('course'));
    }

    // Show the form to edit an existing course
    public function edit(Course $course)
    {
        // Pass the course to the edit view
        return view('courses.edit', compact('course'));
    }

    // Update an existing course
    public function update(Request $request, Course $course)
    {
        // Validate request data
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'credits'     => 'required|integer|min:1|max:10',
        ]);

        // Update the course with the validated fields
        $course->update($request->only('title', 'description', 'credits'));

        // Redirect back to courses list
        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    // Delete a course
    public function destroy(Course $course)
    {
        // Delete the course from the database
        $course->delete();

        // Redirect with confirmation message
        return redirect()->route('courses.index')
            ->with('success', 'Course deleted.');
    }
}