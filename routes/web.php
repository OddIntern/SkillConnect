<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExperienceController;




Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/discover', [App\Http\Controllers\ProjectController::class, 'index'])->name('discover');


Route::middleware('auth')->group(function () {
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::patch('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'update'])->name('public-profile.update');
});

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');


Route::post('/experience', [ExperienceController::class, 'store'])->name('experience.store');


require __DIR__.'/auth.php';