<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\DisponibiliteController;
use App\Http\Controllers\InfirmierController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileInfirmierController;
use App\Http\Controllers\RendezvousController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth','confirm.password'])->group(function(){
Route::get('/admin/infirmiers', [AdminController::class, 'liste_compte_infirmier'])->name('admin.infirmiers');
Route::post('/admin/infirmiers/{id}/accepter', [AdminController::class, 'accepter'])->name('admin.infirmiers.accepter');
Route::post('/admin/infirmiers/{id}/refuser', [AdminController::class, 'refuser'])->name('admin.infirmiers.refuser');
Route::post('/bloque_infirmier/{id}', [AdminController::class, 'bloquer_compte_infirmier'])->name('bloque_infirmier');
Route::post('/bloque_patient/{id}', [AdminController::class, 'bloquer_compte_patient'])->name('bloque_patient');
Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileInfirmierController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileInfirmierController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileInfirmierController::class, 'destroy'])->name('profile.destroy');
    Route::post('/rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store');
    Route::get('/profilepatient', [ProfileInfirmierController::class, 'index'])->name('profile_patient.index');
    Route::post('/avis',[AvisController::class,'store']);
    Route::delete('/avis/{id}',[AvisController::class,'destroy']);

    Route::post('/disponibilite/save', [DisponibiliteController::class, 'save'])->name('disponibilite.save');
    Route::get('/disponibilites',[DisponibiliteController::class, 'indexInfirmier'])->name('disponibilites.index');

    Route::get('/rv',[RendezvousController::class,'rv_infirmier'])->name('rv.infirmier');
    Route::put('/rv/accept/{id}',[RendezvousController::class,'accepter'])->name('rv.accepter');
    Route::put('/rv/refuse/{id}',[RendezvousController::class,'refuser'])->name('rv.refuser');
    Route::post('/rv',[RendezvousController::class,'rvParDate'])->name('rvParDate');
});


Route::get('/role', [AuthController::class,'role'])->name('role');

Route::get('/inscription/{role}', [AuthController::class,'inscrire'])
    ->name('inscrire');

Route::post('/inscription', [AuthController::class,'store'])
    ->name('inscription.store');
Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
Route::post('/connexion', [AuthController::class, 'login'])->name('login.post');

Route::get('/attente', function () {
    return view('infirmiers.attente');
})->name('attente');



Route::get('/recherche',[InfirmierController::class,'index'])->name('rechercher');

Route::get('/infirmier/{id}',[InfirmierController::class,'show']);





require __DIR__.'/auth.php';
