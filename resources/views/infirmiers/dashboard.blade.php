<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.dashboard_title') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar">

    <div class="nav-content">

        <a href="#" class="logo">
            <i class="fa-solid fa-hand-holding-droplet"></i>
            {{ __('site_name') }}
        </a>

        <div class="nav-links">
            <a href="{{ route('admin.infirmiers') }}">{{__('liste_patients')}}</a>
            <a href="{{ route('dashboard') }}">{{ __('dashboard_title') }}</a>
            <a href="{{ url('lang/fr') }}">FR</a>
            <a href="{{ url('lang/ar') }}">AR</a>   
        </div>

        

        <div class="user-box">

            <span class="user-name">
                {{ __('hello') }},
                {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn-logout">{{ __('logout') }}</button>
            </form>

        </div>
    </div>

</nav>


<div class="container py-5">

    <h2 class="mb-4">{{ __('dashboard_title') }}</h2>

    {{-- CARDS --}}
    <div class="row g-4 mb-5">

        <div class="col-md-3">
            <div class="card-dashboard bg1">
                <h5>{{ __('patients') }}</h5>
                <h1>{{ $nb_patients }}</h1>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-dashboard bg2">
                <h5>{{ __('infirmiers') }}</h5>
                <h1>{{ $nb_infirmiers }}</h1>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-dashboard bg3">
                <h5>{{ __('rendez_vous') }}</h5>
                <h1>{{ $nb_rv }}</h1>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-dashboard bg4">
                <h5>{{ __('comptes_attente') }}</h5>
                <h1>{{ $nb_compte_attente }}</h1>
            </div>
        </div>

    </div>

    {{-- INFIRMIERS --}}
    <div class="table-container mb-5">

        <h4 class="mb-3">{{ __('liste_infirmiers') }}</h4>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">
                <tr>
                    <th>{{ __('id') }}</th>
                    <th>{{ __('infirmier') }}</th>
                    <th>{{ __('specialite') }}</th>
                    <th>{{ __('experience_ans') }}</th>
                    <th>{{ __('action') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach($liste_infirmier as $i)
                    <tr>
                        <td>{{ $i->id }}</td>
                        <td>{{ $i->user->nom }} {{ $i->user->prenom }}</td>
                        <td>{{ $i->specialite }}</td>
                        <td>{{ $i->experience }}</td>
                        <td>
                            <form action="{{ route('bloque_infirmier',$i->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">
                                    {{ __('bloquer_compte') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    {{-- PATIENTS --}}
    <div class="table-container mb-5">

        <h4 class="mb-3">{{ __('liste_patients') }}</h4>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">
                <tr>
                    <th>{{ __('id') }}</th>
                    <th>{{ __('nom') }}</th>
                    <th>{{ __('email') }}</th>
                    <th>{{ __('telephone') }}</th>
                    <th>{{ __('action') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach($liste_patient as $i)
                    <tr>
                        <td>{{ $i->id }}</td>
                        <td>{{ $i->user->nom }} {{ $i->user->prenom }}</td>
                        <td>{{ $i->user->email }}</td>
                        <td>{{ $i->user->telephone }}</td>
                        <td>
                            <form action="{{ route('bloque_patient',$i->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">
                                    {{ __('bloquer_compte') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    {{-- RENDEZ-VOUS --}}
    <div class="table-container mb-5">

        <h4 class="mb-3">{{ __('liste_rendezvous') }}</h4>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">
                <tr>
                    <th>{{ __('id') }}</th>
                    <th>{{ __('infirmier') }}</th>
                    <th>{{ __('date') }}</th>
                    <th>{{ __('etat') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach($rv_de_infirmier as $rv)
                    <tr>
                        <td>{{ $rv->id }}</td>
                        <td>{{ $rv->infirmier->user->nom }} {{ $rv->infirmier->user->prenom }}</td>
                        <td>{{ $rv->date }}</td>
                        <td>
                            @if($rv->etat == 'en_attente')
                                {{ __('en_attente') }}
                            @elseif($rv->etat == 'accepte')
                                {{ __('accepte') }}
                            @else
                                {{ __('refuser') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    {{-- AVIS --}}
    <div class="table-container">

        <h4 class="mb-3">{{ __('avis_infirmiers') }}</h4>

        <table class="table table-bordered table-hover">

            <thead class="table-success">
                <tr>
                    <th>{{ __('id') }}</th>
                    <th>{{ __('infirmier') }}</th>
                    <th>{{ __('nom') }}</th>
                    <th>{{ __('commentaire') }}</th>
                    <th>{{ __('note') }}</th>
                    <th>{{ __('action') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach($compte_infirmier as $avis)
                    <tr>
                        <td>{{ $avis->id }}</td>
                        <td>{{ $avis->infirmier->user->nom ?? '---' }}</td>
                        <td>{{ $avis->patient->user->nom ?? '---' }}</td>
                        <td>{{ $avis->commentaire }}</td>
                        <td>{{ $avis->note }}/5</td>
                        <td>
                            <form action="/avis/{{ $avis->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">
                                    {{ __('supprimer_avis') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

</body>
</html>