<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    
    public function store(Request $request)
    {

        Avis::create([

            'commentaire'=>$request->commentaire,

            'note'=>$request->note,

            'patient_id'=>$request->patient_id,

            'infirmier_id'=>$request->infirmier_id

        ]);

        return redirect()
        ->back()
        ->with(
            'success',
            'Avis ajouté avec succès'
        );

    }
     public function destroy($id)
    {

        $avis=Avis::findOrFail($id);

        $avis->delete();

        return redirect()
        ->back()
        ->with(
            'success',
            'Avis supprimé'
        );

    }


}
