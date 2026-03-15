<?php

use App\Http\Controllers\StudentController;

Route::resource('students', StudentController::class);
Route::resource('courses',  CourseController::class);