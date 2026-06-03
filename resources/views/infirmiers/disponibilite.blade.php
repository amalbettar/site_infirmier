<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>{{ __('availability_title') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/disponibilite.css') }}">
</head>

<body>

<nav class="navbar">

    <div class="nav-content">

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

<div class="container">

    <h2>{{ __('my_availability') }}</h2>

    <table>

        <tr>
            <th>{{ __('day') }}</th>
            <th>{{ __('start_time') }}</th>
            <th>{{ __('end_time') }}</th>
            <th>{{ __('action') }}</th>
        </tr>

        @foreach($days as $day)

        <tr>

            <form action="{{ route('disponibilite.save') }}" method="POST">

                @csrf

                <td>
                    {{ \Carbon\Carbon::parse($day->jour)->translatedFormat('l d/m/Y') }}
                    <input type="hidden" name="jour" value="{{ $day->jour }}">
                </td>

                <td>
                    @if(\Carbon\Carbon::parse($day->jour)->isPast() && !\Carbon\Carbon::parse($day->jour)->isToday())
                        <input disabled value="{{ $day->heure_debut }}">
                    @else
                        <input type="time" name="heure_debut" value="{{ $day->heure_debut }}">
                    @endif
                </td>

                <td>
                    @if(\Carbon\Carbon::parse($day->jour)->isPast() && !\Carbon\Carbon::parse($day->jour)->isToday())
                        <input disabled value="{{ $day->heure_fin }}">
                    @else
                        <input type="time" name="heure_fin" value="{{ $day->heure_fin }}">
                    @endif
                </td>

                <td>
                    @if(\Carbon\Carbon::parse($day->jour)->isPast() && !\Carbon\Carbon::parse($day->jour)->isToday())
                        <button class="expire" disabled>{{ __('expired') }}</button>
                    @else
                        <button  type="submit">{{ __('update') }}</button>
                    @endif
                </td>

            </form>

        </tr>

        @endforeach

    </table>

</div>

</body>
</html>