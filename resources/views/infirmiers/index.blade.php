<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        <style>

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    font-family: Arial, sans-serif;
    background: #f4f7fb;
    margin: 0;
}
/* NavBar */

.navbar{
    
            background: #0d6efd;
            padding: 15px 0;
            width: 100%;
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

/* Container */


.container{

            width: 90%;
            max-width: 1200px;
            margin: auto;
            
        }

.container h1{
    text-align: center;
    color: #0f4c81;
    margin-bottom: 35px;
    font-size: 38px;
}

/* Search Form */

.search-form{
    background: white;
    padding: 25px;
    border-radius: 15px;
    display: flex;
    gap: 15px;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 40px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.search-form select{
    padding: 12px 15px;
    border: 1px solid #dcdcdc;
    border-radius: 10px;
    width: 230px;
    font-size: 15px;
    outline: none;
    transition: 0.3s;
}

.search-form select:focus{
    border-color: #0f4c81;
}

.search-form button{
    padding: 12px 28px;
    border: none;
    border-radius: 10px;
    background: #0f4c81;
    color: white;
    font-size: 15px;
    cursor: pointer;
    transition: 0.3s;
}

.search-form button:hover{
    background: #16639f;
    transform: translateY(-2px);
}

/* Cards */

.cards{
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(260px,1fr));
    gap: 25px;
}

/* Card */

.card{
    background: white;
    border-radius: 18px;
    overflow: hidden;
    text-align: center;
    padding-bottom: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.card:hover{
    transform: translateY(-8px);
}

.card img{
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.card h3{
    margin-top: 18px;
    color: #0f4c81;
    font-size: 24px;
}

.card p{
    color: #666;
    margin-top: 8px;
    font-size: 15px;
}

.card a{
    display: inline-block;
    margin-top: 18px;
    text-decoration: none;
    background: #0f4c81;
    color: white;
    padding: 10px 22px;
    border-radius: 8px;
    transition: 0.3s;
}

.card a:hover{
    background: #16639f;
}

/* Responsive */

@media(max-width:768px){

    .container h1{
        font-size: 30px;
    }

    .search-form{
        flex-direction: column;
    }

    .search-form select,
    .search-form button{
        width: 100%;
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
            <a href="{{ route('profile_patient.index') }}"><i class="fa-user"></i></a>
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