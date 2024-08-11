<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicalRecordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('registration', [AuthController::class, 'registration']);
    Route::post('login', [AuthController::class, 'login']);
});
Route::prefix('medical-records')->middleware('auth:sanctum')->group(function () {
    Route::post('save', [MedicalRecordController::class, 'saveMedicalRecord']);
    Route::get('/', [MedicalRecordController::class, 'getMedicalRecord']);
});