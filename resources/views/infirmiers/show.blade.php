<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('title_profile') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/show.css') }}">
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
                <a href="{{ route('profile_patient.index') }}"><i class="fas fa-user"></i></a>
            @endauth
            <a href="{{ url('lang/fr') }}">FR</a>

            <a href="{{ url('lang/ar') }}">AR</a>

            @if(Auth::check())

                <div class="user-box">

                    <span class="user-name">
                        {{ __('hello') }},
                        {{ ucfirst(Auth::user()->prenom) }} {{ ucfirst(Auth::user()->nom) }}
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

    </div>
</nav>

<div class="profil">

    <img src="{{ asset($infirmier->user->photo) }}">

    <h1>
        <i class="fa-solid fa-user-nurse"></i>
        {{ ucfirst($infirmier->user->nom) }} {{ ucfirst($infirmier->user->prenom) }}
    </h1>

    <p>
        <strong>{{ __('speciality') }} :</strong> {{ $infirmier->specialite }}
    </p>

    <p>
        <strong>{{ __('contact') }} :</strong>
        <strong>{{ __('email') }} :</strong> {{ $infirmier->user->email }}
        <strong>{{ __('phone') }} :</strong> {{ $infirmier->user->telephone }}
    </p>

    <p>
        <strong>{{ __('city') }} :</strong> {{ $infirmier->user->ville }}
    </p>

    <p>{{ $infirmier->description }}</p>

    <p><strong>{{ __('availabilities') }}</strong></p>

    <table border="2">
        <tr>
            <th>{{ __('day') }}</th>
            <th>{{ __('start_time') }}</th>
            <th>{{ __('end_time') }}</th>
            <th>{{ __('choose_time') }}</th>
            <th>{{ __('confirm') }}</th>
        </tr>

        @foreach($infirmier->disponibilites as $disponibilite)
            @if($disponibilite->heure_debut && $disponibilite->heure_fin)

                <tr>

                    <td>{{ \Carbon\Carbon::parse($disponibilite->jour)->translatedFormat('l') }}</td>

                    <td>{{ \Carbon\Carbon::parse($disponibilite->heure_debut)->format('H:i') }}</td>

                    <td>{{ \Carbon\Carbon::parse($disponibilite->heure_fin)->format('H:i') }}</td>

                    <td>

                        <form action="{{ route('rendezvous.store', $infirmier->id) }}" method="POST">
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
                                    @php $debut = strtotime('+10 minutes', $debut); @endphp
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
                                    @php $debut = strtotime('+15 minutes', $debut); @endphp
                                @endwhile
                            </select>

                    </td>

                    <td>
                        <button type="submit">
                            {{ __('confirm_rv') }}
                        </button>
                        </form>
                    </td>

                </tr>

            @endif
        @endforeach

    </table>
</div>

<div class="profil-container">

    @auth
    <div class="avis-form">

        <h2>{{ __('add_review') }}</h2>

        <form action="/avis" method="POST">
            @csrf

            <input type="hidden" name="patient_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="infirmier_id" value="{{ $infirmier->id }}">

            <textarea name="commentaire" placeholder="{{ __('your_comment') }}" required></textarea>

            <label>{{ __('note') }} :</label>

            <select name="note">
                <option value="1">1 ⭐</option>
                <option value="2">2 ⭐</option>
                <option value="3">3 ⭐</option>
                <option value="4">4 ⭐</option>
                <option value="5">5 ⭐</option>
            </select>

            <button type="submit">
                {{ __('add_review_btn') }}
            </button>

        </form>

    </div>
    @endauth

    <div class="avis-list">

        <h2>{{ __('patient_reviews') }}</h2>

        @foreach($avis as $avi)

        <div class="card">

            <b>
                {{ ucfirst($avi->patient->user->nom) }}
                {{ ucfirst($avi->patient->user->prenom) }}
            </b>

            <p>{{ $avi->commentaire }}</p>

            <p>⭐ {{ $avi->note }}/5</p>

        </div>

        @endforeach

    </div>

</div>

</body>
</html>