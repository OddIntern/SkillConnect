<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\LandingPageController; 
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\FollowController;






Route::get('/', LandingPageController::class)->name('welcome');


Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/discover', [App\Http\Controllers\ProjectController::class, 'index'])->name('discover');

//Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::patch('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'update'])->name('public-profile.update');
    Route::post('/projects/{project}/save', [ProjectController::class, 'toggleSave'])->name('projects.toggleSave');
});

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');

// experiences in user profile
Route::post('/experience', [ExperienceController::class, 'store'])->name('experience.store');
Route::get('/experience/{experience}/edit', [ExperienceController::class, 'edit'])->name('experience.edit');
Route::patch('/experience/{experience}', [ExperienceController::class, 'update'])->name('experience.update');
Route::delete('/experience/{experience}', [ExperienceController::class, 'destroy'])->name('experience.destroy');


// Messages
Route::get('/messages', [ConversationController::class, 'index'])->name('messages.index');
// This route will handle the form submission from the "Message" button
Route::get('/messages/start/{user}', [ConversationController::class, 'start'])->name('messages.start');
// This route will display a specific conversation and its messages
Route::get('/messages/{conversation}', [ConversationController::class, 'show'])->name('messages.show');
Route::post('/messages/{conversation}', [ConversationController::class, 'storeMessage'])->name('messages.store');

Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');


Route::post('/projects/{project}/comments', [CommentController::class, 'store'])->name('comments.store');

// Baru detail proyek
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');


// Followers/Following
Route::post('/users/{user}/follow', [FollowController::class, 'toggle'])->name('users.follow');

Route::post('/projects/{project}/apply', [ProjectController::class, 'apply'])->name('projects.apply');
Route::patch('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');


Route::middleware('auth')->group(function () {
    // Route untuk update aplikasi (accept/decline)
    Route::patch('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
}); 

Route::post('/projects/{project}/like', [ProjectController::class, 'toggleLike'])->name('projects.toggleLike');
require __DIR__.'/auth.php';