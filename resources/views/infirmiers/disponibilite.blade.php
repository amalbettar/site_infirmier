<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disponibilité</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            margin: 0;
            padding: 0;
            font-size: 16px;
            color: #333;
        }
        .navbar {
            background: #0d6efd;
            padding: 15px 0;
            width: 100%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2px 80px;
        }

        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-links a {
            color: white;
            font-size: 16px;
            text-decoration: none;
            transition: 0.3s;
            font-weight: bolder;
        }

        .nav-links a:hover {
            color: #dbeafe;
        }

        .btn-login {
            background: white;
            color: #0d6efd !important;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
        }

        /* User Box */

        .user-box {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(255, 255, 255, 0.15);
            padding: 9px 15px;
            border-radius: 10px;
        }

        .user-name {
            color: white;
            font-weight: bold;
            font-size: 15px;
        }

        .btn-logout {
            background: #492dbb;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #dc3545;
        }


        .container{
            width: 900px;
            margin: auto;
        }

        h2{
            text-align: center;
            margin-bottom: 20px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td{
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th{
            background: #0d6efd;
            color: white;
        }

        input{
            padding: 8px;
            width: 120px;
        }

        button{
            background: #198754;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }
        .expire{
            background: red;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover{
            background: #157347;
        }
        .expire:hover{
            background: #de1010;
        }

        
    </style>

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