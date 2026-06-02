<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soins Infirmiers à Domicile</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('styles/welcome.css') }}">
</head>

<body>

{{-- Navbar --}}
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

{{-- Hero --}}
<section class="hero">

    <div class="container">

        <div class="hero-content">

            <h1>
                Soins infirmiers à domicile
            </h1>

            <p>
                Des infirmières qualifiées disponibles pour vos soins
                à domicile en toute sécurité.
            </p>

            <div class="hero-buttons">

                <a href="{{ route('rechercher') }}" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>
                    Rechercher un infirmier
                </a>

                <a href="#services" class="btn btn-outline">
                    Nos services
                </a>

            </div>

        </div>

    </div>

</section>

{{-- Services --}}
<section id="services">

    <div class="container">

        <h2 class="section-title">
            Nos Services
        </h2>

        
          <div class="services-grid">

    @foreach ($service as $s)

        <div class="service-card">

            <i class="fa-solid fa-user-nurse"></i>

            <h3>{{ $s }}</h3>

        </div>

    @endforeach

</div>

        

    </div>

</section>

{{-- Pourquoi nous --}}
<section class="bg-light" id="about">

    <div class="container">

        <h2 class="section-title">
            Pourquoi nous choisir ?
        </h2>

        <div class="about-grid">

            <div class="about-box">

                <i class="fa-solid fa-circle-check"></i>

                <h4>Professionnelles</h4>

            </div>

            <div class="about-box">

                <i class="fa-solid fa-clock"></i>

                <h4>Disponible 24h/24</h4>

            </div>

            <div class="about-box">

                <i class="fa-solid fa-truck-medical"></i>

                <h4>Intervention rapide</h4>

            </div>

            <div class="about-box">

                <i class="fa-solid fa-notes-medical"></i>

                <h4>Suivi médical</h4>

            </div>

        </div>

    </div>

</section>

{{-- Comment ça marche --}}
<section>

    <div class="container">

        <h2 class="section-title">
            Comment ça marche ?
        </h2>

        <div class="steps-grid">

            <div class="step-box">

                <h1>1️⃣</h1>

                <h4>Rechercher un infirmier</h4>

            </div>

            <div class="step-box">

                <h1>2️⃣</h1>

                <h4>Prendre votre rendez-vous</h4>

            </div>

            <div class="step-box">

                <h1>3️⃣</h1>

                <h4>Intervention à domicile</h4>

            </div>

        </div>

    </div>

</section>

{{-- Stats --}}
<section class="stats">

    <div class="container">

        <div class="stats-grid">

            <div class="stats-box">

                <h1>{{ $nb_patient }}</h1>
                <p>Patients</p>

            </div>

            <div class="stats-box">

                <h1>{{ $nb_infirmier }}</h1>
                <p>Infirmières</p>

            </div>

           

        </div>

    </div>

</section>

{{-- Footer --}}
<footer>

    <div class="container">

        <p>
            © 2026 Soins Infirmiers à Domicile - Tous droits réservés
        </p>

    </div>

</footer>

</body>
</html>