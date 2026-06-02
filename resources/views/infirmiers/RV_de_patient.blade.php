<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

<title>Mes Rendez-vous</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('styles/rv_patient.css') }}">
    
</head>
<body>
    <!-- Navbar -->

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
                @endif

            </div>

        </div>
    </nav>

<!-- Rendez-vous -->

<section class="container">

    <h1 class="title">
        Liste de mes rendez-vous
    </h1>

    <div class="cards">

        @forelse($rendezvous as $rdv)

            <div class="card">

                <img src="{{ asset( $rdv->infirmier->user->photo) }}">

                <h3>
                    {{ $rdv->infirmier->user->nom }} {{ $rdv->infirmier->user->prenom }}
                </h3>

                <p>
                    <strong>Spécialité:</strong>
                    {{ $rdv->infirmier->specialite }}
                </p>

                <p>
                    <strong>Date:</strong>
                    {{ $rdv->date }}
                </p>

                <p>
                    <strong>Heure de debut:</strong>
                    {{ $rdv->heure_debut }}
                </p>
                <p>
                    <strong>Heure de fin:</strong>
                    {{ $rdv->heure_fin }}
                </p>

                <p>
                    <strong>Service:</strong>
                    {{ $rdv->service }}
                </p>

                <p>
                    <strong>Etat:</strong>

                    <span class="status {{ $rdv->etat }}">
                        {{ $rdv->etat }}
                    </span>
                </p>

                @if($rdv->etat == 'en_attente')

                    <a href="{{ route('rv.annule', $rdv->id )}}"
                       class="btn">

                        Annuler

                    </a>

                @endif

            </div>

        @empty

            <p>Aucun rendez-vous trouvé</p>

        @endforelse

    </div>

</section>
</body>
</html>