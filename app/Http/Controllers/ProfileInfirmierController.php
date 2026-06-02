<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Infirmier;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileInfirmierController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'infirmier') {
            $id = Auth::id();
            $infos = User::with('infirmier')->findOrFail($id);
            $avis = Avis::with(['infirmier.user', 'patient.user'])->where('infirmier_id', $id)->get();
            return view('infirmiers.profilInfirmier', compact('infos', 'avis'));
        } elseif (auth()->user()->role == 'patient') {
            $id = Auth::id();
            $infos = User::with('patient')->findOrFail($id);
            return view('infirmiers.profilePatient', compact('infos'));
        }

    }
    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        $infirmier = Infirmier::find(Auth::id());

        // update photo
            $photoPath = $user->photo;
            if ($request->hasFile('photo')) {

                // delete old photo
                if ($user->photo && file_exists(public_path($user->photo))) {
                    unlink(public_path($user->photo)); //supprime photo mn public/photos
                }

                // upload new photo
                $photoName = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('photos'), $photoName);
                $photoPath = 'photos/' . $photoName;
                if ($request->field == 'photo') {
                    $user->update([
                        'photo' => $photoPath
                    ]);
                }

            }
            //update pswd
            $pswd = $request->password;

            if ($request->field == 'password') {
                if ($pswd) {
                $user->update([
                    'password' => Hash::make($pswd)
                ]);
                }   
            }
            
            if ($request->field == 'telephone') {
                $user->update([
                    'telephone' => $request->telephone
                ]);
            }
            

            if ($request->field == 'email') {
                $user->update([
                    'email' => $request->email
                ]);
            }


            if ($request->field == 'password') {
                $user->update([
                    'password' => $pswd
                ]);
            }

            
        if (auth()->user()->role == 'infirmier') {
            if ($request->field == 'specialite') {
                $infirmier->update([
                    'specialite' => $request->specialite
                ]);
            }
            if ($request->field == 'experience') {
                $infirmier->update([
                    'experience' => $request->experience
                ]);
            }
            if ($request->field == 'description') {
                $infirmier->update([
                    'description' => $request->description
                ]);
            }
            if ($request->field == 'status') {
                $infirmier->update([
                    'status' => $request->status
                ]);
            }
        }
        


        return redirect()->back()->with('success', 'Profil modifié avec succès');
    }
}
