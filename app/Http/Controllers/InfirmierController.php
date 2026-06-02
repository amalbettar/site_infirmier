<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Infirmier;
use App\Models\Rendezvous;
use App\Models\User;
use Illuminate\Http\Request;


class InfirmierController extends Controller
{

    public function index(Request $request)
    {
        $query = Infirmier::query();

        // Recherche par ville 

        if ($request->filled('ville')) {  // filled katcheck si vide ou non

            $query->whereHas('user', function ($q) use ($request) { // whereHas : filtrage
                $q->where('ville', $request->ville);
            });

        }

        // Recherche par service
        if ($request->filled('service')) {
            $query->where('specialite', $request->service);
        }

        // Afficher les infirmiers
        $infirmiers = $query->get();

        return view('infirmiers.index', compact('infirmiers'));
    }
    public function show($id)
    {
 
    $infirmier = Infirmier::with([
        'user',
        'disponibilites' => function ($query) {

            $query->where(function ($q) {

                $q->where('jour', '>', now()->toDateString())

                    ->orWhere(function ($q2) {

                        $q2->where('jour', now()->toDateString());

                    });

            })
            ->orderBy('jour')
            ->orderBy('heure_debut');

        }
    ])->findOrFail($id);




        $avis = Avis::with(['infirmier.user', 'patient.user'])
            ->where('infirmier_id', $id)
            ->get();

        return view('infirmiers.show', compact('infirmier', 'avis'));
    }
}
