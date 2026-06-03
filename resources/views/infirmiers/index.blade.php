<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>{{ __('search_title') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/recherche.css') }}">
</head>

<body>

<nav class="navbar">

    <div class="container nav-content">

        <a href="#" class="logo">
            <i class="fa-solid fa-hand-holding-droplet"></i>
            {{ __('site_name') }}
        </a>

        <div class="nav-links">

            <a href="{{ route('home') }}">{{ __('home') }}</a>
            <a href="{{ route('rechercher') }}">{{ __('search_nurse') }}</a>

            

            @auth
                <a href="{{ route('rv_patient') }}">{{ __('my_appointments') }}</a>
                <a href="{{ route('profile_patient.index') }}">
                    <i class="fas fa-user"></i>
                </a>
            @endauth
            <a href="{{ url('lang/fr') }}">FR</a>
            <a href="{{ url('lang/ar') }}">AR</a>
        </div>
        @if(Auth::check())
        <div class="user-box">

            <span class="user-name">
                {{ __('hello') }},
                {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
            </span>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    {{ __('logout') }}
                </button>
            </form>
        </div>
            @else
                <a href="/login" class="btn-login">{{ __('login') }}</a>
                <a href="/role" class="btn-login">{{ __('register') }}</a>
        
        @endif
    </div>

</nav>

<div class="container">

    <h1>{{ __('nurses_list') }}</h1>

    <form method="GET" action="{{ route('rechercher') }}" class="search-form">

        <select name="ville">
            <option value="">{{ __('choose_city') }}</option>
            <option value="Casablanca">Casablanca</option>
            <option value="Rabat">Rabat</option>
            <option value="Marrakech">Marrakech</option>
            <option value="Safi">Safi</option>
            <option value="Tanger">Tanger</option>
        </select>

        <select name="service">
            <option value="">{{ __('choose_service') }}</option>
            <option value="Soins à domicile">Soins à domicile</option>
            <option value="Pédiatrie">Pédiatrie</option>
            <option value="Gériatrie">Gériatrie</option>
            <option value="Urgence">Urgence</option>
            <option value="Injection">Injection</option>
        </select>

        <button type="submit">
            {{ __('search') }}
        </button>

    </form>

    <div class="cards">

        @foreach($infirmiers as $infirmier)

        <div class="card">

            <img src="{{ asset($infirmier->user->photo) }}">

            <h3>
                {{ $infirmier->user->nom }} {{ $infirmier->user->prenom }}
            </h3>

            <p>{{ $infirmier->specialite }}</p>

            <p>{{ $infirmier->user->ville }}</p>

            <a href="/infirmier/{{$infirmier->id}}">
                {{ __('view_profile') }}
            </a>

        </div>

        @endforeach

    </div>

</div>

</body>
</html>