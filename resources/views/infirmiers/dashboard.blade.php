<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<nav class="navbar">
<div class=" nav-content">

    <a href="#" class="logo">
        <i class="fa-solid fa-hand-holding-droplet"></i>
        Infirmières à Domicile
    </a>

    <div class="nav-links">
        <a href="{{ route('admin.infirmiers') }}">Liste infirmier</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        
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
<div class="container py-5">
    

    <h2 class="mb-4">Dashboard Admin</h2>

    {{-- Cards --}}
    <div class="row g-4 mb-5">

        <div class="col-md-3">
            <div class="card-dashboard bg1">
                <h5>Patients</h5>
                <h1>{{ $nb_patients }}</h1>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-dashboard bg2">
                <h5>Infirmiers</h5>
                <h1>{{ $nb_infirmiers }}</h1>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-dashboard bg3">
                <h5>Rendez-vous</h5>
                <h1>{{ $nb_rv }}</h1>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-dashboard bg4">
                <h5>Comptes en attente</h5>
                <h1>{{ $nb_compte_attente }}</h1>
            </div>
        </div>

    </div>

    {{-- liste infirmierss --}}
    <div class="table-container mb-5">

        <h4 class="mb-3">Liste des infirmiers</h4>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Infirmier</th>
                    <th>Specialite</th>
                    <th>Experiance (ans)</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($liste_infirmier as $i)

                    <tr>
                        <td>{{ $i->id }}</td>
                        <td>{{ $i->user->nom  }} {{ $i->user->prenom  }}</td>
                        <td>{{ $i->specialite }}</td>
                        <td>{{ $i->experience }}</td>
                        <td>
                            <form action="{{ route('bloque_infirmier',$i->id) }}" method="post">
                                
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">Bloquer Copmte</button>
                            </form>
                        </td>
                        
                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>
    {{-- liste patients --}}
    <div class="table-container mb-5">

        <h4 class="mb-3">Liste des Patients</h4>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Patients</th>
                    <th>email</th>
                    <th>telephone </th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($liste_patient as $i)

                    <tr>
                        <td>{{ $i->id }}</td>
                        <td>{{ $i->user->nom  }} {{ $i->user->prenom  }}</td>
                        <td>{{ $i->user->email }}</td>
                        <td>{{ $i->user->telephone }}</td>
                        <td>
                            <form action="{{ route('bloque_patient',$i->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">Bloquer Copmte</button>
                            </form>
                        </td>
                        
                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    {{-- Rendez-vous --}}
    <div class="table-container mb-5">

        <h4 class="mb-3">Liste des Rendez-vous</h4>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Infirmier</th>
                    <th>Date</th>
                    <th>Etat</th>
                </tr>
            </thead>

            <tbody>

                @foreach($rv_de_infirmier as $rv)

                    <tr>
                        <td>{{ $rv->id }}</td>
                        <td>{{ $rv->infirmier->user->nom  }} {{ $rv->infirmier->user->prenom  }}</td>
                        <td>{{ $rv->date }}</td>
                        <td>

@if($rv->etat == 'en_attente')

    <span class="status en_attente">
        En attente
    </span>

@elseif($rv->etat == 'accepte')

    <span class="status accepte">
        Accepté
    </span>

@else

    <span class="status refuse">
        Refusé
    </span>

@endif

</td>
                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>
    

    {{-- Avis --}}
    <div class="table-container">

        <h4 class="mb-3">Avis des Infirmiers</h4>

        <table class="table table-bordered table-hover">

            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Infirmier</th><th>Patient</th>
                    <th>Commentaire</th>
                    <th>Note</th><th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($compte_infirmier as $avis)

                    <tr>
                        <td>{{ $avis->id }}</td>
                        <td>{{ $avis->infirmier->user->nom ?? '---' }} {{ $avis->infirmier->user->prenom ?? '---' }}</td>
                        <td>{{ $avis->patient->user->nom ?? '---' }} {{ $avis->patient->user->prenom ?? '---' }}</td>
                        <td>{{ $avis->commentaire }}</td>
                        <td>{{ $avis->note }}/5</td>
                        <td>
                            <form action="/avis/{{$avis->id}}" method="post">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">Supprimer Avis</button>
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