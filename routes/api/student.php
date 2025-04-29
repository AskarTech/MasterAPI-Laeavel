
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::GET('/students', [StudentController::class, 'index']);
    Route::GET('/students/{id}', [StudentController::class, 'get']);
    Route::POST('/students', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'softDelete']);
});