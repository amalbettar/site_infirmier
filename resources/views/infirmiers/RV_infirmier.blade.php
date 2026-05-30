<!-- resources/views/infirmiers/RV_infirmier.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body{
    font-family: Arial, sans-serif;
    background: #f4f7fb;
    margin: 0;
    padding: 0;
    color: #333;
}

/* ===== NAVBAR ===== */

.navbar{
    background: #0d6efd;
    padding: 15px 40px;
    width: 100%;
    box-sizing: border-box;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
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
    text-decoration: none;
}

.logo i{
    margin-right: 8px;
}

.nav-links{
    display: flex;
    align-items: center;
    gap: 25px;
}

.nav-links a{
    color: white;
    text-decoration: none;
    font-size: 16px;
    transition: 0.3s;
    font-weight: bolder;
}

.nav-links a:hover{
    color: #dbeafe;
}

/* ===== USER BOX ===== */

.user-box{
    display: flex;
    align-items: center;
    gap: 15px;
    background: rgba(255,255,255,0.15);
    padding: 10px 16px;
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
    padding: 9px 15px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
}

.btn-logout:hover{
    background: #dc3545;
}

/* ===== TITRES ===== */

h1,
h2{
    text-align: center;
    margin-top: 40px;
    color: #0d6efd;
}

/* ===== TABLE ===== */

table{
    width: 92%;
    margin: 25px auto;
    border-collapse: collapse;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

table th{
    background: #0d6efd;
    color: white;
    padding: 15px;
    font-size: 15px;
}

table td{
    padding: 14px;
    text-align: center;
    border-bottom: 1px solid #eee;
    font-size: 15px;
}

table tr:hover{
    background: #f9fbff;
}

/* ===== BUTTONS ===== */

button{
    border: none;
    padding: 10px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
}

button:hover{
    transform: scale(1.03);
}

/* bouton accepter */

form button[type="submit"]{
    background: #198754;
    color: white;
}

form button[type="submit"]:hover{
    background: #157347;
}

/* bouton refuser */

td:last-child form button{
    background: #dc3545;
}

td:last-child form button:hover{
    background: #bb2d3b;
}

/* ===== FILTRE ===== */

form{
    text-align: center;
}

select{
    padding: 12px 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
    width: 220px;
    font-size: 15px;
    outline: none;
    margin-right: 10px;
}

select:focus{
    border-color: #0d6efd;
}

/* ===== MESSAGE VIDE ===== */

td[colspan]{
    padding: 25px;
    color: #777;
    font-style: italic;
}

/* ===== RESPONSIVE ===== */

@media(max-width: 992px){

    .nav-content{
        flex-direction: column;
        gap: 20px;
    }

    .nav-links{
        flex-wrap: wrap;
        justify-content: center;
    }

    .user-box{
        flex-direction: column;
    }

    table{
        width: 98%;
        font-size: 14px;
    }

    table th,
    table td{
        padding: 10px;
    }

    select{
        width: 100%;
        margin-bottom: 10px;
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
                    {{ \Carbon\Carbon::parse($rv->date)->locale('fr')->translatedFormat('l') }}
                </td>

                <td>{{ $rv->date }}</td>

                <td>{{ $rv->heure_debut }}</td>

                <td>{{ $rv->heure_fin }}</td>

                <td>{{ $rv->etat }}</td>

                <td>
                    <form action="{{ route('rv.accepter',$rv->id) }}" method="post">

                        @csrf
                        @method('PUT')

                        <button type="submit">
                            Accepter
                        </button>

                    </form>
                </td>

                <td>
                    <form action="{{ route('rv.refuser',$rv->id) }}" method="post">

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

        <button type="submit">
            Filtrer
        </button>

    </form>

    <br>

    <table border="1">

        <tr>
            <th>Date</th>
            <th>Heure début</th>
            <th>Heure fin</th>
            <th>Etat</th>
        </tr>

        @forelse($rvParDate as $rv)

        <tr>

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