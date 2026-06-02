<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disponibilité</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/disponibilite.css') }}">
</head>
<body>
   <nav class="navbar">
<div class=" nav-content">

    <a href="#" class="logo">
        <i class="fa-solid fa-hand-holding-droplet"></i>
        Infirmières à Domicile
    </a>

    <div class="nav-links">
        <a href="{{ route('rv.infirmier') }}">Rendez-vous</a>
        <a href="{{ route('disponibilites.index') }}">Disponibilités</a>
        <a href="{{ route('profile.index') }}">Profile</a>
    </div>

    <div class="user-box">
        <span class="user-name">
            Bonjour, {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
        </span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn-logout">Déconnexion</button>
        </form>
    </div>

</div>
</nav> 

<div class="container">
    

    <h2>Mes disponibilités</h2>

    <table>

        <tr>
            <th>Jour</th>
            <th>Heure début</th>
            <th>Heure fin</th>
            <th>Action</th>
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

                            <input
                                type="time"
                                class="form-control"
                                value="{{ $day->heure_debut }}"
                                disabled
                            >
                            

                        @else
                    <input
                        type="time"
                        name="heure_debut"
                        value="{{ $day->heure_debut }}"
                    >
                    @endif
                </td>

                <td>
                     @if(\Carbon\Carbon::parse($day->jour)->isPast() && !\Carbon\Carbon::parse($day->jour)->isToday())

                            <input
                                type="time"
                                class="form-control"
                                value="{{ $day->heure_fin }}"
                                disabled
                            >

                        @else
                    <input
                        type="time"
                        name="heure_fin"
                        value="{{ $day->heure_fin }}"
                    >
                    @endif
                </td>

                <td>
                    @if(\Carbon\Carbon::parse($day->jour)->isPast() && !\Carbon\Carbon::parse($day->jour)->isToday())

                            <button
                                class="expire"
                                disabled
                            >
                                Expiré
                            </button>

                        @else
                    <button type="submit">
                        Modifier
                    </button>
                    @endif
                </td>

            </form>

        </tr>

        @endforeach

    </table>

</div>

</body>
</html>