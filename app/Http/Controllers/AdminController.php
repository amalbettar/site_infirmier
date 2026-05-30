<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Disponibilite;
use App\Models\Infirmier;
use App\Models\Patient;
use App\Models\Rendezvous;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $nb_patients=Patient::count();
        $nb_infirmiers=Infirmier::count();
        $nb_rv=Rendezvous::count();
        $nb_compte_attente=Infirmier::where('validation','en_attente')->count();

        $liste_infirmier=Infirmier::with('user')->get();
        $liste_patient=Patient::with('user')->get();
        $rv_de_infirmier=Rendezvous::with('infirmier.user')->get();
        
        $compte_infirmier=Avis::with(['infirmier.user','patient.user'])->get();
        return view('infirmiers.dashboard',compact('compte_infirmier','liste_patient','liste_infirmier','nb_compte_attente','nb_infirmiers','nb_patients','nb_rv','rv_de_infirmier'));
    }
   
    public function liste_compte_infirmier(){
        $infirmiers=Infirmier::with('user')->get();
        return view('infirmiers.liste_compte',compact('infirmiers'));
    }
    public function accepter($id)
    {
        $infirmier = Infirmier::findOrFail($id);

        $infirmier->validation = 'accepte';

        $infirmier->save();

        return back()->with('success', 'Compte accepté.');
    }

     public function refuser($id)
    {
        $infirmier = Infirmier::findOrFail($id);

        $infirmier->validation = 'refuse';

        $infirmier->save();

        return back()->with('success', 'Compte refusé.');
    }
    public function bloquer_compte_infirmier($id){
        $inf=Infirmier::findOrFail($id);
        $inf->delete();
        return redirect()->back();
    }
    public function bloquer_compte_patient($id){
        $p=Patient::findOrFail($id);
        $p->delete();
        return redirect()->back();
    }
}

