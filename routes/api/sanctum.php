
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanctumController;

Route::group(['middleware' => []], function () {
    Route::get('/sanctum/test', [SanctumController::class, 'testSanctum']);
    Route::post('/sanctum/token', [SanctumController::class, 'issueToken']);
    Route::post('/sanctum/revoke-token', [SanctumController::class, 'revokeToken']);
});