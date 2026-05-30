<?php

namespace App\Http\Controllers;

use App\Models\Disponibilite;
use App\Models\Infirmier;
use App\Models\Rendezvous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RendezvousController extends Controller
{
    public function rv_infirmier(){
        $id=Auth::id();
        $rvs=Rendezvous::where('infirmier_id',$id)->get();
        $rvParDate = collect();

        return view('infirmiers.RV_infirmier', compact('rvs', 'rvParDate'));
    }
    public function accepter($id){
        $rv=Rendezvous::findOrFail($id);
        $rv->update(['etat'=>'confirme']);
        return back();
    }
    public function refuser($id){
        $rv=Rendezvous::findOrFail($id);
        $rv->update(['etat'=>'annule']);
        return back();
    }
    public function rvParDate(Request $request){
        $id = Auth::id();

    $rvs = Rendezvous::where('infirmier_id', $id)->get();

    $date = $request->date;

    $rvParDate = Rendezvous::whereRaw('DAYNAME(date) = ?', [$date])
        ->where('infirmier_id', $id)
        ->where('etat', 'confirme')
        ->get();

    return view('infirmiers.RV_infirmier', compact('rvs', 'rvParDate'));
    }


    public function store(Request $request)
{

        $infirmier_id = $request->infirmier_id;
        $date = $request->date;
        $heure_debut = $request->heure_debut;
        $heure_fin = $request->heure_fin;
        $service=$request->service;
       Rendezvous::create([
            'date' => $date,
            'heure_debut' => $heure_debut,
            'heure_fin' => $heure_fin,
            'service' => $service,
            'etat' => 'en_attente',
            'patient_id' => auth()->id(),
            'infirmier_id' => $infirmier_id,
        ]);
        return redirect()->back();
}
}
