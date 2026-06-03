<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('title_rendezvous') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/rv_inf.css') }}">
</head>

<body>

<nav class="navbar">

    <div class="container nav-content">

        <a href="#" class="logo">
            <i class="fa-solid fa-hand-holding-droplet"></i>
            {{ __('site_name') }}
        </a>

        <div class="nav-links">

            <a href="{{ route('rv.infirmier') }}">{{ __('appointments') }}</a>
            <a href="{{ route('disponibilites.index') }}">{{ __('availability') }}</a>
            
            <a href="{{ route('profile.index') }}">{{ __('profile') }}</a>
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

<h1>{{ __('pending_rvs') }}</h1>

<table border="1">

    <tr>
        <th>{{ __('day') }}</th>
        <th>{{ __('patient') }}</th>
        <th>{{ __('phone') }}</th>
        <th>{{ __('email') }}</th>
        <th>{{ __('date') }}</th>
        <th>{{ __('start_time') }}</th>
        <th>{{ __('end_time') }}</th>
        <th>{{ __('etat') }}</th>
        <th>{{ __('accept') }}</th>
        <th>{{ __('reject') }}</th>
    </tr>

    @forelse($rvs as $rv)

        @if($rv->etat == 'en_attente')

        <tr>

            <td>{{ ucfirst(\Carbon\Carbon::parse($rv->date)->locale(app()->getLocale())->translatedFormat('l')) }}</td>

            <td>{{ ucfirst($rv->patient->user->nom) }} {{ ucfirst($rv->patient->user->prenom) }}</td>

            <td>{{ $rv->patient->user->telephone }}</td>

            <td>{{ $rv->patient->user->email }}</td>

            <td>{{ $rv->date }}</td>

            <td>{{ $rv->heure_debut }}</td>

            <td>{{ $rv->heure_fin }}</td>

            <td>{{ $rv->etat }}</td>

            <td>
                <form action="{{ route('rv.accepter', $rv->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit">{{ __('accept_btn') }}</button>
                </form>
            </td>

            <td>
                <form action="{{ route('rv.refuser', $rv->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit">{{ __('reject_btn') }}</button>
                </form>
            </td>

        </tr>

        @endif

    @empty

        <tr>
            <td colspan="10">{{ __('no_rv') }}</td>
        </tr>

    @endforelse

</table>

<br><br>

<h1>{{ __('filter_title') }}</h1>

<form method="post" action="{{ route('rvParDate') }}">
    @csrf

    <select name="date">
        <option value="Monday">{{ __('monday') }}</option>
        <option value="Tuesday">{{ __('tuesday') }}</option>
        <option value="Wednesday">{{ __('wednesday') }}</option>
        <option value="Thursday">{{ __('thursday') }}</option>
        <option value="Friday">{{ __('friday') }}</option>
        <option value="Saturday">{{ __('saturday') }}</option>
        <option value="Sunday">{{ __('sunday') }}</option>
    </select>

    <button type="submit">{{ __('filter') }}</button>

</form>

<br>

<table border="1">

    <tr>
        <th>{{ __('day') }}</th>
        <th>{{ __('patient') }}</th>
        <th>{{ __('phone') }}</th>
        <th>{{ __('email') }}</th>
        <th>{{ __('date') }}</th>
        <th>{{ __('start_time') }}</th>
        <th>{{ __('end_time') }}</th>
        <th>{{ __('etat') }}</th>
    </tr>

    @forelse($rvParDate as $rv)

    <tr>

        <td>{{ ucfirst(\Carbon\Carbon::parse($rv->date)->locale(app()->getLocale())->translatedFormat('l')) }}</td>

        <td>{{ ucfirst($rv->patient->user->nom) }} {{ ucfirst($rv->patient->user->prenom) }}</td>

        <td>{{ $rv->patient->user->telephone }}</td>

        <td>{{ $rv->patient->user->email }}</td>

        <td>{{ $rv->date }}</td>

        <td>{{ $rv->heure_debut }}</td>

        <td>{{ $rv->heure_fin }}</td>

        <td>{{ $rv->etat }}</td>

    </tr>

    @empty

    <tr>
        <td colspan="8">{{ __('no_accepted_rv') }}</td>
    </tr>

    @endforelse

</table>

</body>
</html>