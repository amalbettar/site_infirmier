<?php

namespace App\Http\Controllers;

use App\Models\Infirmier;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InfirmierController extends Controller
{

   

    public function role(){
        return view('auth.choix-role');
    }
    public function inscrire($role)
    {
        return view('auth.register',compact('role'));
    }

    public function store(Request $request)
    {
        
        $request->validate([

            'nom' => 'required',
            'prenom' => 'required',

            'email' => 'required|email|unique:users',

            'telephone' => ['required', 'regex:/^[0-9]{10}$/'],

            'password' => 'required|min:6|confirmed',

            'specialite' => 'required_if:role,infirmier',

            'experience' => 'required_if:role,infirmier|integer',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $photoName = null;

        if($request->hasFile('photo'))
        {
            $photoName = time().'.'.$request->photo->extension();

            $request->photo->move(
                public_path('photos'),
                $photoName
            );
        }

        $user = User::create([

            'nom' => $request->nom,
            'prenom' => $request->prenom,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'adresse' => $request->adresse,

            'telephone' => $request->telephone,

            'ville' => $request->ville,

            'photo' => $photoName,

            'role' => $request->role
        ]);
        if($request->role==='patient'){
            Patient::create(['id'=>$user->id]);
            return view('auth.login');
        }


        if($request->role==='infirmier'){
            Infirmier::create([

            'id' => $user->id,

            'specialite' => $request->specialite,

            'experience' => $request->experience,

            'status' => 'disponible',

            'description' => $request->description,

            'validation' => 'en_attente'
            ]);
            return view('infirmiers.attente');
        }

        
        
        //hadi khasha changement mn ba3d !!!

        return 'Inscription réussie';
    }
}
