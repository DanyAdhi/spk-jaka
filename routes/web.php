<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PeriodController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/period/create', [PeriodController::class, 'index']);


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
     
    // Router participant
    // Route::get('participant', [ParticipantsController::class, 'show']);

});

