
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsCoursesEnrollmentController;

Route::group(
    ["middleware" => ["auth:sanctum"]],
    function () {
        Route::POST("/enrollments", [StudentsCoursesEnrollmentController::class, "update"]);
        Route::GET("/enrollments/{id}", [StudentsCoursesEnrollmentController::class, "get"]);
        Route::GET("/enrollments", [StudentsCoursesEnrollmentController::class, "index"]);
        Route::DELETE("/enrollments/{id}", [StudentsCoursesEnrollmentController::class, "softDelete"]);
    }
);