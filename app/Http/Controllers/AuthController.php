<?php

namespace App\Http\Controllers;

use App\Models\Infirmier;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $validation = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validation)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // infirmier en attente
            if ($user->role === 'infirmier') {

                $infirmier = Infirmier::find($user->id);

                if ($infirmier && $infirmier->validation === 'en_attente') {

                    Auth::logout();

                    return redirect()->route('attente')
                        ->with('status', 'en_attente');
                }
                elseif ($infirmier && $infirmier->validation === 'refuse') {

                    Auth::logout();

                    return redirect()->route('attente')
                        ->with('status', 'refuse');
                }
                return redirect()->route('rv.infirmier');
            }

            // patient
            if ($user->role == 'patient') {
                return redirect()->route('home');
            }

            // admin
            if ($user->role == 'admin') {
                return redirect()->route('admin.infirmiers');
            }

            // autres rôles 
            return back();
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect',
        ]);
    }

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

            'email' => 'required|email|unique:users,email',

            'telephone' => ['required', 'regex:/^[0-9]{10}$/'],

            'password' => 'required|min:6|confirmed',

            'specialite' => 'required_if:role,infirmier',

            'experience' => 'required_if:role,infirmier|integer',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ],[
            'email.unique' => 'Cet email existe déjà.',
            'telephone.regex' => 'Le numéro doit contenir 10 chiffres.',
            'password.confirmed' => 'La confirmation du mot de passe est incorrecte.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
    
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