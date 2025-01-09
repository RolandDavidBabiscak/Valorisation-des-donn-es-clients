<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepriseController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/entreprises', [EntrepriseController::class, 'index']); // Récupérer toutes les entreprises
Route::get('/entreprises/{id}', [EntrepriseController::class, 'show']); // Récupérer une entreprise spécifique par l'id
Route::get('/entreprises/siren/{siren}', [EntrepriseController::class, 'searchBySiren']); // Récupérer une entreprise spécifique par le siren
Route::post('/store', [EntrepriseController::class, 'store'])->name('entreprise.store'); // Ajouter une entreprise