<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:#f4f7fb;
}

/* ===== NAVBAR ===== */

.navbar{
    background:#2563eb;
    padding:15px 0;
    width:100%;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
}

.nav-content{
    width:90%;
    margin:auto;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:20px;
}

.logo{
    color:white;
    font-size:24px;
    font-weight:bold;
    text-decoration:none;
}

.logo i{
    margin-right:8px;
}

.nav-links{
    display:flex;
    align-items:center;
    gap:25px;
}

.nav-links a{
    color:white;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}

.nav-links a:hover{
    color:#dbeafe;
}

.user-box{
    display:flex;
    align-items:center;
    gap:15px;
    background:rgba(255,255,255,0.15);
    padding:10px 15px;
    border-radius:12px;
}

.user-name{
    color:white;
    font-weight:bold;
    font-size:15px;
}

.btn-logout{
    background:#1e40af;
    color:white;
    border:none;
    padding:9px 15px;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
}

.btn-logout:hover{
    background:#dc2626;
}

/* ===== TITLES ===== */

h2{
    color:#1e3a5f;
    font-weight:bold;
    margin-bottom:30px;
}

h4{
    color:#1e3a5f;
    font-weight:bold;
}

/* ===== CARDS ===== */

.card-dashboard{
    border:none;
    border-radius:20px;
    padding:25px;
    color:white;
    transition:0.3s;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.card-dashboard:hover{
    transform:translateY(-6px);
}

.card-dashboard h5{
    font-size:18px;
    margin-bottom:10px;
}

.card-dashboard h1{
    font-size:40px;
    font-weight:bold;
}

.bg1{
    background:linear-gradient(135deg,#4e73df,#224abe);
}

.bg2{
    background:linear-gradient(135deg,#1cc88a,#13855c);
}

.bg3{
    background:linear-gradient(135deg,#36b9cc,#258391);
}

.bg4{
    background:linear-gradient(135deg,#f6c23e,#dda20a);
}

/* ===== TABLE CONTAINER ===== */

.table-container{
    background:white;
    border-radius:20px;
    padding:25px;
    margin-bottom:35px;
    box-shadow:0 3px 15px rgba(0,0,0,0.06);
}

/* ===== TABLE ===== */

.table{
    margin-bottom:0;
}

.table thead{
    background:#2563eb;
    color:white;
}

.table thead th{
    padding:16px;
    text-align:center;
    font-size:15px;
    border:none;
}

.table tbody td{
    padding:15px;
    text-align:center;
    vertical-align:middle;
}

.table tbody tr{
    transition:0.3s;
}

.table tbody tr:hover{
    background:#f8fbff;
}

/* ===== BUTTONS ===== */

.btn-action{
    border:none;
    padding:10px 16px;
    border-radius:8px;
    color:white;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

.btn-delete{
    background:#ef4444;
}

.btn-delete:hover{
    background:#dc2626;
}

/* ===== STATUS ===== */

.status{
    padding:7px 14px;
    border-radius:20px;
    color:white;
    font-size:14px;
    font-weight:bold;
}

.en_attente{
    background:#f59e0b;
}

.accepte{
    background:#10b981;
}

.refuse{
    background:#ef4444;
}

/* ===== RESPONSIVE ===== */

@media(max-width:992px){

    .nav-content{
        flex-direction:column;
        text-align:center;
    }

    .nav-links{
        flex-wrap:wrap;
        justify-content:center;
    }

}

@media(max-width:768px){

    .card-dashboard h1{
        font-size:30px;
    }

    .table-container{
        overflow-x:auto;
    }

    .table{
        min-width:700px;
    }

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