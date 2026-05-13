<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $validation = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($validation)) {

    //مهمة للأمان:
    // كتمنع session fixation attack
    // كتبدل session ID بعد login
        $request->session()->regenerate();

        // redirect حسب role ila 3andk
        if (Auth::user()->role == 'infirmier') {
            return redirect('/dashboard-infirmier');
        }

        if (Auth::user()->role == 'patient') {
            return redirect('/');
        }

        return redirect('/');
    }

    return back()->withErrors([
        'email' => 'Email ou mot de passe incorrect',
    ]);
}
}
