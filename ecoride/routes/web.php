<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

// Routes Breeze (Authentification)
require __DIR__ . '/auth.php';

// ====================== ROUTES PUBLIQUES (Visiteurs) ======================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Recherche et liste des trajets accessibles sans connexion
Route::get('/search', [RideController::class, 'search'])->name('rides.search');
Route::get('/rides', [RideController::class, 'index'])->name('rides.index');

// ====================== ROUTES PROTÉGÉES (Connecté) ======================
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Trajets (sauf index et search qui sont publics)
    Route::resource('rides', RideController::class)->except(['index', 'search']);

    Route::post('/rides/{ride}/reserve', [RideController::class, 'reserve'])->name('rides.reserve');
    Route::get('/my-rides', [RideController::class, 'myRides'])->name('rides.history');
    Route::get('/rides/{ride}/review', [RideController::class, 'review'])->name('rides.review');
    Route::post('/rides/{ride}/review', [RideController::class, 'storeReview'])->name('rides.review.store');

    // Véhicules
    Route::resource('vehicles', VehicleController::class);

    // Profil Breeze
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ====================== ADMIN & EMPLOYEE ======================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews');
    Route::post('/reviews/{review}/validate', [AdminController::class, 'validateReview'])->name('reviews.validate');
    Route::post('/reviews/{review}/refuse', [AdminController::class, 'refuseReview'])->name('reviews.refuse');
});

Route::middleware(['auth', 'role:employee'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
    Route::get('/reviews', [EmployeeController::class, 'reviews'])->name('reviews');
    Route::post('/reviews/{review}/validate', [EmployeeController::class, 'validateReview'])->name('reviews.validate');
    Route::post('/reviews/{review}/refuse', [EmployeeController::class, 'refuseReview'])->name('reviews.refuse');
});