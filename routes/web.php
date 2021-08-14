<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ParticipantScoreController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\RankingController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('admin', [AuthController::class, 'index']);
Route::get('admin/login', [AuthController::class, 'index'])->name('login');
Route::post('admin/login', [AuthController::class, 'authLogin']);

Route::prefix('admin')-> middleware('auth')->group(function (){
    Route::get('logout', [AuthController::class, 'authLogout']);
    
    // Router Dashboard 
    Route::get('dashboard', [DashboardController::class, 'index']);

    // Router Period
    Route::prefix('period')->group(function() {
        Route::get('/create', [PeriodController::class, 'create']);
        Route::get('/', [PeriodController::class, 'index']);
        Route::get('/{id}', [PeriodController::class, 'edit']);
        Route::put('/{id}', [PeriodController::class, 'update']);
        Route::post('/', [PeriodController::class, 'store']);
        Route::put('/update-status/{id}', [PeriodController::class, 'updateStatus']);
        Route::delete('/{id}', [PeriodController::class, 'deletePeriod']);
    });
     
    // Router faculty
    Route::prefix('faculty')->group(function() {
        Route::get('/', [FacultyController::class, 'index']);
        Route::get('/{id}', [FacultyController::class, 'show']);
        Route::post('/', [FacultyController::class, 'store']);
        Route::put('/{id}', [FacultyController::class, 'update']);
        Route::delete('/{id}', [FacultyController::class, 'destroy']);
    });

    // Router participant
    Route::prefix('participant')->group(function(){
        Route::get('/', [ParticipantController::class, 'index']);
        Route::get('/create', [ParticipantController::class, 'create']);
        Route::post('/', [ParticipantController::class, 'store']);
        Route::get('/{id}', [ParticipantController::class, 'edit']);
        Route::put('/{id}', [ParticipantController::class, 'update']);
        Route::delete('/{id}', [ParticipantController::class, 'destroy']);
    });

    // Router participant score
    Route::prefix('participant-score')->group(function() {
        Route::get('/', [ParticipantScoreController::class, 'index']);
        Route::get('/{id}', [ParticipantScoreController::class, 'edit']);
        Route::put('/{id}', [ParticipantScoreController::class, 'update']);
    });

    // Router Weight
    Route::prefix('weight')->group(function() {
        Route::post('/process', [WeightController::class, 'processAhp']);
        Route::get('/', [WeightController::class, 'index']);
    });
    
    // Router Ranking
    Route::prefix('ranking')->group(function(){
        Route::get('/saw-process', [RankingController::class, 'processSaw']);
        Route::get('/', [RankingController::class, 'rankingSaw']);
    });

});

