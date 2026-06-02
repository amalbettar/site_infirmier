<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/liste_compte.css') }}">
    
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
   <h1>Validation des infirmiers</h1>

@if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

<table border="1" cellpadding="10" cellspacing="0" width="100%">

    <thead>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Spécialité</th>
            <th>Expérience</th>
            <th>Ville</th>
            <th>Adresse</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

        @foreach($infirmiers as $infirmier)

            <tr>

                <td>
                    {{ucfirst( $infirmier->user->nom )}}
                    {{ucfirst( $infirmier->user->prenom )}}
                </td>

                <td>
                    {{ $infirmier->user->email }}
                </td>

                <td>
                    {{ $infirmier->specialite }}
                </td>

                <td>
                    {{ucfirst($infirmier->experience)  }} ans
                </td>
                <td>
                    {{ ucfirst($infirmier->user->ville) }}
                </td>
                <td>
                    {{ucfirst($infirmier->user->adresse)  }}
                </td>

                <td data-label="Status">

    @if($infirmier->validation == 'en_attente')
        <span class="status en_attente">
            En attente
        </span>

    @elseif($infirmier->validation == 'accepte')
        <span class="status accepte">
            Accepté
        </span>

    @else
        <span class="status refuse">
            Refusé
        </span>
    @endif

</td>

                <td >

                    @if($infirmier->validation === 'en_attente')

                        <form action="{{ route('admin.infirmiers.accepter', $infirmier->id) }}"
                              method="POST"
                              style="display:inline-block;">

                            @csrf

                            <button type="submit" class="action-btn btn-accept">
                                Accepter
                            </button>
                        </form>

                        <form action="{{ route('admin.infirmiers.refuser', $infirmier->id) }}"
                              method="POST"
                              style="display:inline-block;">

                            @csrf

                            <button type="submit" class="action-btn btn-refuse">
                                Refuser
                            </button>
                        </form>

                    @else

                        <form action="{{ route('admin.infirmiers.refuser', $infirmier->id) }}"
                              method="POST"
                              style="display:inline-block;">

                            @csrf

                            <button type="submit" class="action-btn btn-delete">
                                Supprimer Compte
                            </button>
                        </form>

                    @endif

                </td>

            </tr>

        @endforeach

    </tbody>

</table>
</body>
</html>