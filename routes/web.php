<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatController;

// Afficher le formulaire de connexion ou d'inscription
Route::get('/', [AuthController::class, 'showForm'])->name('home');

Route::post('/chat', [ChatController::class, 'handleChat'])->name('chat');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// 📌 Route vers le formulaire d'inscription (affichage de la vue)
Route::get('/register', function () {
    return view('auth.register'); // Assurez-vous que cette vue existe dans resources/views/auth/
})->name('register');
// 📌 Route pour traiter l'inscription
Route::post('/register', [AuthController::class, 'register']);

// 📌 Route vers le formulaire de connexion (affichage de la vue)
Route::get('/login', function () {
    return view('auth.login'); // Assurez-vous que cette vue existe dans resources/views/auth/
})->name('login');
// 📌 Route pour traiter la connexion
Route::post('/login', [AuthController::class, 'login']);


// 📌 Route pour la déconnexion
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login'); // Rediriger vers la page de connexion
})->name('logout');
