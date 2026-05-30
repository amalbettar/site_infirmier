<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soins Infirmiers à Domicile</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        a{
            text-decoration: none;
        }

        .container{
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        /* Navbar */

        .navbar{
            background: #0d6efd;
            padding: 15px 0;
        }

        .nav-content{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo{
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links{
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-links a{
            color: white;
            font-size: 16px;
            font-weight: bolder;
        }

        .btn-login{
            background: white;
            color: #0d6efd !important;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
        }

        /* Hero */

        .hero{
            background:
            linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
            url('photos/home_photo.png');

            background-size: cover;
            background-position: center;
            height: 90vh;

            display: flex;
            align-items: center;

            color: white;
        }

        .hero-content{
            max-width: 600px;
        }

        .hero h1{
            font-size: 55px;
            margin-bottom: 20px;
        }

        .hero p{
            font-size: 20px;
            margin-bottom: 30px;
        }

        .hero-buttons{
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn{
            padding: 14px 28px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            display: inline-block;
        }

        .btn-primary{
            background: #0d6efd;
            color: white;
        }

        .btn-outline{
            border: 2px solid white;
            color: white;
        }
        .user-box{
    display: flex;
    align-items: center;
    gap: 15px;
    background: rgba(255,255,255,0.15);
    padding: 8px 15px;
    border-radius: 10px;
}

.user-name{
    color: white;
    font-weight: bold;
    font-size: 15px;
}

.btn-logout{
    background: #492dbb;
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
}

.btn-logout:hover{
    background: #dc3545;
}

        /* Sections */

        section{
            padding: 70px 0;
        }

        .section-title{
            text-align: center;
            font-size: 38px;
            margin-bottom: 50px;
            font-weight: bold;
        }

        /* Services */

        .services-grid{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
            gap: 25px;
        }

        .service-card{
            background: white;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);

            transition: 0.3s;
        }

        .service-card:hover{
            transform: translateY(-8px);
        }

        .service-card i{
            font-size: 45px;
            color: #0d6efd;
            margin-bottom: 20px;
        }

        /* About */

        .bg-light{
            background: #f5f5f5;
        }

        .about-grid{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px,1fr));
            gap: 25px;
            text-align: center;
        }

        .about-box i{
            font-size: 45px;
            color: #0d6efd;
            margin-bottom: 15px;
        }

        /* Steps */

        .steps-grid{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
            gap: 30px;
            text-align: center;
        }

        .step-box{
            padding: 20px;
        }

        .step-box h1{
            margin-bottom: 15px;
        }

        /* Stats */

        .stats{
            background: #0d6efd;
            color: white;
        }

        .stats-grid{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
            gap: 20px;
            text-align: center;
        }

        .stats-box h1{
            font-size: 45px;
            margin-bottom: 10px;
        }

        /* Footer */

        footer{
            background: #212529;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        /* Responsive */

        @media(max-width: 768px){

            .nav-content{
                flex-direction: column;
                gap: 15px;
            }

            .nav-links{
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero h1{
                font-size: 40px;
            }

            .hero p{
                font-size: 18px;
            }
        }

    </style>
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

            <div class="service-card">

                <i class="fa-solid fa-syringe"></i>

                <h3>Injection</h3>

                <p>
                    Soins d’injection réalisés à domicile.
                </p>

            </div>

            <div class="service-card">

                <i class="fa-solid fa-bandage"></i>

                <h3>Pansement</h3>

                <p>
                    Changement et suivi des pansements.
                </p>

            </div>

            <div class="service-card">

                <i class="fa-solid fa-user-nurse"></i>

                <h3>Soins personnes âgées</h3>

                <p>
                    Assistance et accompagnement médical.
                </p>

            </div>

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

                <h1>+200</h1>
                <p>Patients</p>

            </div>

            <div class="stats-box">

                <h1>+50</h1>
                <p>Infirmières</p>

            </div>

            <div class="stats-box">

                <h1>24/7</h1>
                <p>Disponibilité</p>

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