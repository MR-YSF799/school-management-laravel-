<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;   // ← cette ligne doit exister
use App\Http\Controllers\EnrollmentController; 
Route::resource('students', StudentController::class);
Route::resource('courses',  CourseController::class);

Route::get('/students/{student}/enroll',  [EnrollmentController::class, 'create'])->name('enrollments.create');
Route::post('/enrollments',               [EnrollmentController::class, 'store'])->name('enrollments.store');
Route::put('/enrollments/{enrollment}',   [EnrollmentController::class, 'update'])->name('enrollments.update');
Route::delete('/enrollments/{enrollment}',[EnrollmentController::class, 'destroy'])->name('enrollments.destroy');