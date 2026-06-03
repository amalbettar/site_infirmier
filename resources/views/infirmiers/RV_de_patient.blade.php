<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>{{ __('my_rv_title') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styles/rv_patient.css') }}">
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
                <a href="{{ route('rv_patient') }}">{{ __('my_rv') }}</a>
                <a href="{{ route('profile_patient.index') }}"><i class="fas fa-user"></i></a>
                
            @endauth
            <a href="{{ url('lang/fr') }}">FR</a>

            <a href="{{ url('lang/ar') }}">AR</a>

            @if(Auth::check())

            <div class="user-box">

                <span class="user-name">
                    {{ __('hello') }},
                    {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">{{ __('logout') }}</button>
                </form>

            </div>

            @endif

        </div>

    </div>

</nav>

<section class="container">

    <h1 class="title">{{ __('my_rv_title') }}</h1>

    <div class="cards">

        @forelse($rendezvous as $rdv)
        @if ($rdv->etat !== 'termine')
        
        
        <div class="card">

            <img src="{{ asset($rdv->infirmier->user->photo) }}">

            <h3>
                {{ $rdv->infirmier->user->nom }} {{ $rdv->infirmier->user->prenom }}
            </h3>

            <p><strong>{{ __('speciality') }}:</strong> {{ $rdv->infirmier->specialite }}</p>

            <p><strong>{{ __('date') }}:</strong> {{ $rdv->date }}</p>

            <p><strong>{{ __('start_time') }}:</strong> {{ $rdv->heure_debut }}</p>

            <p><strong>{{ __('end_time') }}:</strong> {{ $rdv->heure_fin }}</p>

            <p><strong>{{ __('service') }}:</strong> {{ $rdv->service }}</p>

            <p>
                <strong>{{ __('status') }}:</strong>
                <span class="status {{ $rdv->etat }}">
                    {{ $rdv->etat }}
                </span>
            </p>

            @if($rdv->etat == 'en_attente')

            <form action="{{ route('rv.annule', $rdv->id )}}" method="post">
                @csrf
                @method('PUT')
                <button class="btn">{{ __('cancel') }}</button>
            </form>

            @endif

        </div>
        @endif
        @empty

        <p>{{ __('no_rv_found') }}</p>

        @endforelse

    </div>

</section>

</body>
</html>