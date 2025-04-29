
<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::GET('/courses', [CourseController::class, 'index']);
    Route::GET('/courses/{id}', [CourseController::class, 'get']);
    Route::POST('/courses', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'softDelete']);
});