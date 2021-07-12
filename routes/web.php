<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PeriodController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ParticipantScoreController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/', [DashboardController::class, 'index']);


Route::prefix('admin')->group(function (){

    // Router Dashboard 
    Route::get('dashboard', [DashboardController::class, 'index']);

    // Router Period
    Route::get('period', [PeriodController::class, 'index']);
    Route::get('period/{id}', [PeriodController::class, 'edit']);
    Route::put('period/{id}', [PeriodController::class, 'update']);
    Route::get('period/create', [PeriodController::class, 'create']);
    Route::post('period/save', [PeriodController::class, 'store']);
    Route::put('period/update-status/{id}', [PeriodController::class, 'updateStatus']);
    Route::delete('period/{id}', [PeriodController::class, 'deletePeriod']);
     
    // Router faculty
    Route::get('faculty', [FacultyController::class, 'index']);
    Route::get('faculty/{id}', [FacultyController::class, 'show']);
    Route::post('faculty', [FacultyController::class, 'store']);
    Route::put('faculty/{id}', [FacultyController::class, 'update']);
    Route::delete('faculty/{id}', [FacultyController::class, 'destroy']);

    // Router participant
    Route::get('participant', [ParticipantController::class, 'index']);
    Route::get('participant/create', [ParticipantController::class, 'create']);
    Route::post('participant', [ParticipantController::class, 'store']);
    Route::get('participant/{id}', [ParticipantController::class, 'edit']);
    Route::put('participant/{id}', [ParticipantController::class, 'update']);
    Route::delete('participant/{id}', [ParticipantController::class, 'destroy']);

    // Router participant score
    Route::get('participant-score', [ParticipantScoreController::class, 'index']);
    Route::get('participant-score/{id}', [ParticipantScoreController::class, 'edit']);
    Route::post('participant-score/{id}', [ParticipantScoreController::class, 'store']);
    

});

