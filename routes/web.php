<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\CommentaireController;


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
Route::get('/entreprise/{id}', [EntrepriseController::class, 'show'])->name('entreprise.show'); // Récupérer une entreprise
Route::get('/entreprises/siren/{siren}', [EntrepriseController::class, 'searchBySiren']); // Récupérer une entreprise spécifique par le siren
Route::post('/store', [EntrepriseController::class, 'store'])->name('entreprise.store'); // Ajouter une entreprise
Route::post('/store', [CommentaireController::class, 'store'])->name('commentaire.store'); // Ajouter un commentaire
Route::get('/show', [CommentaireController::class, 'show'])->name('public.show'); // Afficher un commentaire spécifique
