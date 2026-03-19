<?php
namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Affiche le formulaire d'inscription (depuis la page d'un étudiant)
    public function create(Student $student)
    {
        // Récupère les cours auxquels l'étudiant n'est PAS encore inscrit
        $courses = Course::whereNotIn('id', $student->courses->pluck('id'))->get();
        return view('enrollments.create', compact('student', 'courses'));
    }

    // Enregistre l'inscription
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id'  => 'required|exists:courses,id',
            'grade'      => 'nullable|numeric|min:0|max:20',
        ]);

        // Vérifie si l'étudiant est déjà inscrit à ce cours
        $exists = Enrollment::where('student_id', $request->student_id)
                            ->where('course_id', $request->course_id)
                            ->exists();

        if ($exists) {
            return back()->with('error', 'Cet étudiant est déjà inscrit à ce cours.');
        }

        Enrollment::create($request->only('student_id', 'course_id', 'grade'));

        return redirect()->route('students.show', $request->student_id)
                         ->with('success', 'Inscription réussie !');
    }

    // Met à jour la note
    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'grade' => 'nullable|numeric|min:0|max:20',
        ]);

        $enrollment->update(['grade' => $request->grade]);

        return redirect()->route('students.show', $enrollment->student_id)
                         ->with('success', 'Note mise à jour.');
    }

    // Supprime l'inscription
    public function destroy(Enrollment $enrollment)
    {
        $student_id = $enrollment->student_id;
        $enrollment->delete();

        return redirect()->route('students.show', $student_id)
                         ->with('success', 'Inscription supprimée.');
    }
}