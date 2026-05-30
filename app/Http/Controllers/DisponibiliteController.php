<?php

namespace App\Http\Controllers;

use App\Models\Disponibilite;
use Illuminate\Http\Request;

class DisponibiliteController extends Controller
{
public function indexInfirmier()
{
    $today = now();
    $startOfWeek = $today->copy()->startOfWeek();

    $days = [];

    for ($i = 0; $i < 7; $i++) {

        $date = $startOfWeek->copy()->addDays($i);

        $dispo = Disponibilite::where('infirmier_id', auth()->id())
            ->where('jour', $date->toDateString())
            ->first();

        // Ila makanch dispo nkhlliw inputs khawyin
        // ila kan heur null kidir objet jdid bach ytal3o khawyin o may3tich erreur
        if (!$dispo) {

            $dispo = new Disponibilite();

            $dispo->jour = $date->toDateString();
            $dispo->heure_debut = null;
            $dispo->heure_fin = null;
        }

        $days[] = $dispo;
    }

    return view('infirmiers.disponibilite', compact('days'));
}
public function save(Request $request)
{
    Disponibilite::updateOrCreate(

        [
            'infirmier_id' => auth()->id(),
            'jour' => $request->jour,
        ],

        [
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
        ]

    );

    return back()->with('success', 'Disponibilité enregistrée');
}
}
