<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
        }

        /* Container */

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        /* Navbar */

        .navbar {
            background: #0d6efd;
            padding: 15px 0;
            width: 100%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-links a {
            color: white;
            font-size: 16px;
            text-decoration: none;
            transition: 0.3s;
            font-weight: bolder;
        }

        .nav-links a:hover {
            color: #dbeafe;
        }

        .btn-login {
            background: white;
            color: #0d6efd !important;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
        }

        /* User Box */

        .user-box {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(255, 255, 255, 0.15);
            padding: 8px 15px;
            border-radius: 10px;
        }

        .user-name {
            color: white;
            font-weight: bold;
            font-size: 15px;
        }

        .btn-logout {
            background: #492dbb;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #dc3545;
        }

        /* Profil */

        .profil {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .profil img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: auto;
            border: 5px solid #0d6efd;
        }

        .profil h1 {
            text-align: center;
            margin-top: 20px;
            color: #0f4c81;
            font-size: 35px;
        }

        .profil p {
            margin-top: 12px;
            font-size: 17px;
            color: #555;
            text-align: center;
        }

        /* Disponibilités */

        .profil p:last-of-type {
            font-size: 28px;
            font-weight: bold;
            color: #0f4c81;
            margin-top: 35px;
            margin-bottom: 20px;
        }

        /* Table */

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden;
            border-radius: 15px;
        }

        table th {
            background: #0d6efd;
            color: white;
            padding: 15px;
            font-size: 15px;
        }

        table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
            background: white;
        }

        table tr:hover td {
            background: #f8fbff;
        }

        /* Select */

        table select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
        }

        /* Button */

        table button {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        table button:hover {
            background: #084298;
        }

        .profil-container {

            width: 80%;
            margin: auto;

        }

        .profil-card {

            background: white;

            padding: 20px;

            border-radius: 15px;

            box-shadow: 0 0 10px #ddd;

            margin-top: 30px;

            text-align: center;

        }

        .profil-card img {

            width: 150px;
            height: 150px;

            border-radius: 50%;

            object-fit: cover;

            margin-bottom: 15px;

        }

        .avis-form {

            background: white;

            padding: 20px;

            border-radius: 15px;

            box-shadow: 0 0 10px #ddd;

            margin-top: 30px;

        }

        .card {

            padding: 15px;

            margin-top: 15px;

            border-radius: 10px;

            box-shadow: 0 0 10px #ddd;

            background: white;

        }

        textarea {

            width: 100%;

            height: 100px;

            padding: 10px;

            border-radius: 10px;

            border: 1px solid #ccc;

        }

        select {

            padding: 10px;

            border-radius: 10px;

        }

        button {

            background: #0d6efd;

            color: white;

            border: none;

            padding: 10px 20px;

            border-radius: 8px;

            cursor: pointer;

            margin-top: 10px;

        }

        .delete-btn {

            background: red;

        }

        button:hover {

            opacity: 0.8;

        }

        /* Responsive */

        @media(max-width:900px) {

            .nav-content {
                flex-direction: column;
                gap: 20px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            table {
                display: block;
                overflow-x: auto;
            }

            .profil {
                padding: 20px;
            }

            .profil h1 {
                font-size: 28px;
            }

        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="container nav-content">

            <a href="#" class="logo">
                <i class="fa-solid fa-hand-holding-droplet"></i>
                Infirmières à Domicile
            </a>

            <div class="nav-links">

                <a href="{{ route('home') }}"></i>Accueil</a>
            
            <a href="{{ route('rechercher') }}">Rechercher des infirmiers</a>
            @auth
            <a href="{{ route('profile_patient.index') }}"><i class="fa-solid fa-user"></i></a>
            @endauth

                @if(Auth::check())

                    <div class="user-box">

                        <span class="user-name">
                            Bonjour, {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
                        </span>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="btn-logout">
                                Déconnexion
                            </button>

                        </form>

                    </div>

                @else

                    <a href="/login" class="btn-login">
                        Connexion
                    </a>

                    <a href="/role" class="btn-login">
                        Inscription
                    </a>

                @endif

            </div>

        </div>
    </nav>
    <div class="profil">

        <img src="{{asset($infirmier->user->photo)}}">

        <h1>{{$infirmier->user->nom}} {{$infirmier->user->prenom}}</h1>

        <p>{{$infirmier->specialite}}</p>

        <p>{{$infirmier->user->email}}</p>

        <p>{{$infirmier->user->ville}}</p>

        <p>{{$infirmier->user->telephone}}</p>

        <p>{{$infirmier->description}}</p>

        <p>Disponnibilites</p>
        <table border="2">
            <tr>
                <th>jour</th>
                <th>heure de debut</th>
                <th>heure de fin</th>
                <th>Choisisser un temps disponnible </th>
                <th>Comfirmer</th>
            </tr>


            @foreach($infirmier->disponibilites as $disponibilite)
                @if($disponibilite->heure_debut && $disponibilite->heure_fin)

                    <tr>

                        <td>{{ \Carbon\Carbon::parse($disponibilite->jour)->translatedFormat('l') }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($disponibilite->heure_debut)->format('H:i') }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($disponibilite->heure_fin)->format('H:i') }}
                        </td>

                        <td>

                            <form action="{{ route('rendezvous.store', $infirmier->id)  }}" method="POST">

                                @csrf

                                <input type="hidden" name="infirmier_id" value="{{ $infirmier->id }}">
                                <input type="hidden" name="service" value="{{ $infirmier->specialite }}">
                                <input type="hidden" name="date" value="{{ $disponibilite->jour }}">
                                <input type="hidden" name="disponibilite_id" value="{{ $disponibilite->id }}">

                                <select name="heure_debut" required>

                                    @php
                                        $debut = strtotime($disponibilite->heure_debut);
                                        $fin = strtotime($disponibilite->heure_fin);
                                    @endphp

                                    @while($debut < $fin)

                                        <option value="{{ date('H:i', $debut) }}">
                                            {{ date('H:i', $debut) }}
                                        </option>

                                        @php
                                            $debut = strtotime('+15 minutes', $debut);
                                        @endphp

                                    @endwhile

                                </select>
                                <select name="heure_fin" required>

                                    @php
                                        $debut = strtotime($disponibilite->heure_debut);
                                        $fin = strtotime($disponibilite->heure_fin);
                                    @endphp

                                    @while($debut < $fin)

                                        <option value="{{ date('H:i', $debut) }}">
                                            {{ date('H:i', $debut) }}
                                        </option>

                                        @php
                                            $debut = strtotime('+15 minutes', $debut);
                                        @endphp

                                    @endwhile

                                </select>

                        </td>

                        <td>

                            <button type="submit">
                                Confirmer RV
                            </button>
                            </form>

                        </td>

                    </tr>

                @endif
            @endforeach

        </table>

        

    </div>
        <div class="profil-container">



            <!-- FORMULAIRE AVIS -->

            <div class="avis-form">

                <h2>Ajouter un avis</h2>

                <form action="/avis" method="POST">

                    @csrf

                    <input type="hidden" name="patient_id" value="{{ auth()->user()->id }}">

                    <input type="hidden" name="infirmier_id" value="{{ $infirmier->id }}">

                    <textarea name="commentaire" placeholder="Votre commentaire..." required></textarea>

                    <br><br>

                    <label>Note :</label>

                    <select name="note">

                        <option value="1">1 ⭐</option>
                        <option value="2">2 ⭐</option>
                        <option value="3">3 ⭐</option>
                        <option value="4">4 ⭐</option>
                        <option value="5">5 ⭐</option>

                    </select>

                    <br><br>

                    <button type="submit">

                        Ajouter avis

                    </button>

                </form>

            </div>

            <!-- AFFICHAGE AVIS -->

            <div class="avis-list">

                <h2>Commentaires des patients</h2>

                @foreach($avis as $avi)

                    <div class="card">

                        <b>

                            {{ $avi->patient->user->nom }}

                        </b>

                        <p>

                            {{ $avi->commentaire }}

                        </p>

                        <p>

                            ⭐ {{ $avi->note }}/5

                        </p>

                    </div>

                @endforeach

            </div>

        </div>



</body>

</html>