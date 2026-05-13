<?php

use App\Http\Controllers\InfirmierController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/role', [InfirmierController::class,'role'])->name('role');

Route::get('/inscription/{role}', [InfirmierController::class,'inscrire'])
    ->name('inscrire');

Route::post('/inscription', [InfirmierController::class,'store'])
    ->name('inscription.store');

Route::get('/attente', function () {
    return view('infirmiers.attente');
})->name('attente');
require __DIR__.'/auth.php';
