<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/rv_inf.css') }}">
</head>

<body>
    <nav class="navbar">
        <div class="container nav-content">

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
    <h1>Les rendez-vous en attente</h1>

    <table border="1">

        <tr>

            <th>Jour</th>
            <th>Patient</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Date</th>
            <th>Heure début</th>
            <th>Heure fin</th>
            <th>Etat</th>
            <th>Accepter</th>
            <th>Refuser</th>
        </tr>

        @forelse($rvs as $rv)

            @if($rv->etat == 'en_attente')

                <tr>


                    <td>
                        {{ucfirst(\Carbon\Carbon::parse($rv->date)->locale('fr')->translatedFormat('l'))  }}
                    </td>
                    <td>{{ucfirst($rv->patient->user->nom)  }} {{ucfirst($rv->patient->user->prenom)  }}</td>
                    <td>{{$rv->patient->user->telephone  }}</td>
                    <td>{{$rv->patient->user->email  }}</td>

                    <td>{{ $rv->date }}</td>

                    <td>{{ $rv->heure_debut }}</td>

                    <td>{{ $rv->heure_fin }}</td>

                    <td>{{ $rv->etat }}</td>

                    <td>
                        <form action="{{ route('rv.accepter', $rv->id) }}" method="post">

                            @csrf
                            @method('PUT')

                            <button type="submit">
                                Accepter
                            </button>

                        </form>
                    </td>

                    <td>
                        <form action="{{ route('rv.refuser', $rv->id) }}" method="post">

                            @csrf
                            @method('PUT')

                            <button type="submit">
                                Refuser
                            </button>

                        </form>
                    </td>

                </tr>

            @endif

        @empty

            <tr>
                <td colspan="7">
                    Aucun rendez-vous
                </td>
            </tr>

        @endforelse

    </table>

    <br><br>

    <h1>Filtrer les rendez-vous acceptés par jour</h1>

    <form method="post" action="{{ route('rvParDate') }}">

        @csrf

        <select name="date">

            <option value="Monday">Lundi</option>

            <option value="Tuesday">Mardi</option>

            <option value="Wednesday">Mercredi</option>

            <option value="Thursday">Jeudi</option>

            <option value="Friday">Vendredi</option>

            <option value="Saturday">Samedi</option>

            <option value="Sunday">Dimanche</option>

        </select>

        <button type="submit" name="filtrer">
            Filtrer
        </button>

    </form>

    <br>

    <table border="1">

        <tr>
            <th>Jour</th>
            <th>Patient</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Date</th>
            <th>Heure début</th>
            <th>Heure fin</th>
            <th>Etat</th>
        </tr>

        @forelse($rvParDate as $rv)

            <tr>
                <td>
                    {{ucfirst(\Carbon\Carbon::parse($rv->date)->locale('fr')->translatedFormat('l'))  }}
                </td>
                <td>{{ucfirst($rv->patient->user->nom)  }} {{ucfirst($rv->patient->user->prenom)  }}</td>
                <td>{{$rv->patient->user->telephone  }}</td>
                <td>{{$rv->patient->user->email  }}</td>

                <td>{{ $rv->date }}</td>

                <td>{{ $rv->heure_debut }}</td>

                <td>{{ $rv->heure_fin }}</td>

                <td>{{ $rv->etat }}</td>

            </tr>

        @empty

            <tr>
                <td colspan="4">
                    Aucun rendez-vous accepté
                </td>
            </tr>

        @endforelse

    </table>

</body>

</html>