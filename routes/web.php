<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\DisponibiliteController;
use App\Http\Controllers\InfirmierController;
use App\Http\Controllers\ProfileInfirmierController;
use App\Http\Controllers\RendezvousController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::get('/lang/{locale}', function ($locale) {

    if(in_array($locale,['fr','ar'])){

        Session::put('locale',$locale);
    }
    

    return redirect()->back();

});


Route::get('/',[AuthController::class,'home'])->name('home');

Route::middleware(['auth','admin'])->group(function(){
Route::get('/admin/infirmiers', [AdminController::class, 'liste_compte_infirmier'])->name('admin.infirmiers');
Route::post('/admin/infirmiers/{id}/accepter', [AdminController::class, 'accepter'])->name('admin.infirmiers.accepter');
Route::post('/admin/infirmiers/{id}/refuser', [AdminController::class, 'refuser'])->name('admin.infirmiers.refuser');
Route::post('/bloque_infirmier/{id}', [AdminController::class, 'bloquer_compte_infirmier'])->name('bloque_infirmier');
Route::post('/bloque_patient/{id}', [AdminController::class, 'bloquer_compte_patient'])->name('bloque_patient');
Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
});

Route::middleware(['auth','patient'])->group(function (){
    Route::post('/avis',[AvisController::class,'store']);
    Route::post('/prendre_rv',[RendezvousController::class,'store'])->name('rendezvous.store');
    Route::get('/rv_patient',[RendezvousController::class,'index'])->name('rv_patient');
    Route::put('/rv_patient/refuse/{id}',[RendezvousController::class,'refuser'])->name('rv.annule');
    Route::get('/profilepatient', [ProfileInfirmierController::class, 'index'])->name('profile_patient.index');
    Route::put('/profilepatient/update', [ProfileInfirmierController::class, 'update'])->name('profile_patient.update');
    
});


Route::middleware(['auth','infirmier'])->group(function () {
    Route::get('/profile', [ProfileInfirmierController::class, 'index'])->name('profile.index');
    
    Route::put('/profile/update', [ProfileInfirmierController::class, 'update'])->name('profile.update');
    Route::delete('/avis/{id}',[AvisController::class,'destroy']);

    Route::post('/disponibilite/save', [DisponibiliteController::class, 'save'])->name('disponibilite.save');
    Route::get('/disponibilites',[DisponibiliteController::class, 'indexInfirmier'])->name('disponibilites.index');

    Route::get('/rv',[RendezvousController::class,'rv_infirmier'])->name('rv.infirmier');
    Route::put('/rv/accept/{id}',[RendezvousController::class,'accepter'])->name('rv.accepter');
    Route::put('/rv/refuse/{id}',[RendezvousController::class,'refuser'])->name('rv.refuser');
    Route::post('/rv',[RendezvousController::class,'rvParDate'])->name('rvParDate');

    Route::get('/attente', function () {return view('infirmiers.attente');})->name('attente');
});


Route::get('/role', [AuthController::class,'role'])->name('role');

Route::get('/inscription/{role}', [AuthController::class,'inscrire'])->name('inscrire');

Route::post('/inscription', [AuthController::class,'store'])->name('inscription.store');
Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
Route::post('/connexion', [AuthController::class, 'login'])->name('login.post');

Route::get('/recherche',[InfirmierController::class,'index'])->name('rechercher');
Route::get('/infirmier/{id}',[InfirmierController::class,'show']);





require __DIR__.'/auth.php';
