<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/recherche.css') }}">

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

    <div class="container">

        <h1>Liste des infirmiers</h1>
        <form method="GET" action="{{ route('rechercher') }}" class="search-form">

            <select name="ville">

                <option value="">Choisir une ville</option>

                <option value="Casablanca">Casablanca</option>
                <option value="Rabat">Rabat</option>
                <option value="Marrakech">Marrakech</option>
                <option value="safi">Safi</option>
                <option value="Tanger">Tanger</option>

            </select>

            <select name="service">

                <option value="">Choisir un service</option>

                <option value="Soins à domicile">Soins à domicile</option>
                <option value="Pédiatrie">Pédiatrie</option>
                <option value="Gériatrie">Gériatrie</option>
                <option value="Urgence">Urgence</option>
                <option value="Injection">Injection</option>

            </select>


            <button type="submit">
                Rechercher
            </button>

        </form>

        <div class="cards">

            @foreach($infirmiers as $infirmier)

                <div class="card">

                    <img src="{{asset($infirmier->user->photo)}}">

                    <h3>{{$infirmier->user->nom}} {{$infirmier->user->prenom}}</h3>

                    <p>{{$infirmier->specialite}}</p>

                    <p>{{$infirmier->user->ville}}</p>

                    <a href="/infirmier/{{$infirmier->id}}">

                        Voir profil

                    </a>

                </div>

            @endforeach

        </div>

    </div>


</body>

</html>