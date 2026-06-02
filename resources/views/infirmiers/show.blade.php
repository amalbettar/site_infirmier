<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/show.css') }}">
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
                <a href="{{ route('rv_patient') }}">Mes Rendez-Vous</a>
                    <a href="{{ route('profile_patient.index') }}"><i class="fas fa-user"></i></a>
                @endauth

                @if(Auth::check())

                    <div class="user-box">

                        <span class="user-name">
                            Bonjour, {{ucfirst(Auth::user()->prenom)  }} {{ucfirst(Auth::user()->nom)  }}
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

        <h1>
            <i class="fa-solid fa-user-nurse"></i>
            {{ ucfirst($infirmier->user->nom) }} {{ ucfirst($infirmier->user->prenom) }}
            <i class="fa-solid fa-user-nurse"></i>
        </h1>

        <p>
            <i class="fa-solid fa-stethoscope"></i>
            <strong>Spécialité :</strong> {{ $infirmier->specialite }}
        </p>

        <p>
            <i class="fa-solid fa-address-card"></i>
            <strong>Pour se connecter avec moi : </strong>
            <i class="fa-solid fa-envelope"></i>
            <strong>Email :</strong> {{ $infirmier->user->email }}
            <i class="fa-solid fa-phone"></i>
            <strong>Téléphone :</strong> {{ $infirmier->user->telephone }}
        </p>



        <p>
            <i class="fa-solid fa-location-dot"></i>
            <strong>Ville :</strong> {{ $infirmier->user->ville }}
        </p>

        <p>
            <i class="fa-solid fa-circle-info"></i>
            {{ $infirmier->description }}
        </p>

        <p>
            <i class="fa-solid fa-calendar-days"></i>
            <strong>Disponibilités</strong>
        </p>
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
        @auth
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
        @endauth

        <!-- AFFICHAGE AVIS -->

        <div class="avis-list">

            <h2>Commentaires des patients</h2>

            @foreach($avis as $avi)

                <div class="card">

                    <b>

                        {{ucfirst($avi->patient->user->nom)  }} {{ucfirst($avi->patient->user->prenom)  }}

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