<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\Auth\AuthController;

// Page d'accueil
Route::get('/', [PageController::class, 'home'])->name('home');

// Routes d'authentification
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
     ->middleware(['auth', 'role:admin'])
     ->name('admin.dashboard');

// Responsable
Route::get('/club/{id}/dashboard', [ClubController::class, 'dashboard'])
     ->middleware(['auth', 'role:responsable'])
     ->name('club.dashboard');
 
    // Routes protégées
    Route::get('/calendrier-evenement/create', [EvenementController::class, 'create'])->name('calendrier.create');
    Route::post('/calendrier-evenement', [EvenementController::class, 'store'])->name('calendrier.store');
    Route::get('/calendrier-evenement/{evenement}/edit', [EvenementController::class, 'edit'])->name('calendrier.edit');
    Route::put('/calendrier-evenement/{evenement}', [EvenementController::class, 'update'])->name('calendrier.update');
    Route::delete('/calendrier-evenement/{evenement}', [EvenementController::class, 'destroy'])->name('calendrier.destroy');
});

// Routes publiques
Route::get('/actualite', [PageController::class, 'actualite'])->name('actualite');
Route::get('/a-propos', [PageController::class, 'apropos'])->name('apropos');
Route::get('/calendrier-evenement', [EvenementController::class, 'index'])->name('calendrier');
Route::get('/calendrier-evenement/{evenement}', [EvenementController::class, 'show'])->name('calendrier.show');
Route::get('/annuaire-club', [PageController::class, 'annuaire'])->name('annuaire');
