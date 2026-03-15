<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;   // ← cette ligne doit exister
Route::resource('students', StudentController::class);
Route::resource('courses',  CourseController::class);