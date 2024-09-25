<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanDetailsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/loan-details', [LoanDetailsController::class, 'index'])->name('loan_details.index');
    Route::get('/emi-details', [LoanDetailsController::class, 'emiDetails'])->name('emi.details');
    Route::get('/process-data', [LoanDetailsController::class, 'processData'])->name('loan_details.process');
});

require __DIR__.'/auth.php';
