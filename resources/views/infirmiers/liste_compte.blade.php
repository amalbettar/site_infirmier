<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
      

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#f4f7fb;
}

/* ===== NAVBAR ===== */

.navbar{
    background:#2563eb;
    width:100%;
    padding:15px 0;
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
    text-decoration:none;
    font-size:24px;
    font-weight:bold;
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
}

.btn-logout{
    background:#1e40af;
    border:none;
    color:white;
    padding:10px 15px;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
}

.btn-logout:hover{
    background:#dc2626;
}

/* ===== PAGE ===== */

h1{
    text-align:center;
    margin:40px 0 25px;
    color:#1e3a5f;
    font-size:35px;
}

/* ===== SUCCESS MESSAGE ===== */

.success-message{
    width:90%;
    margin:0 auto 20px;
    background:#d1fae5;
    color:#065f46;
    padding:15px;
    border-radius:10px;
    border:1px solid #a7f3d0;
    font-weight:bold;
}

/* ===== TABLE ===== */

table{
    width:90%;
    margin:auto;
    border-collapse:collapse;
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

thead{
    background:#2563eb;
    color:white;
}

thead th{
    padding:18px;
    text-align:center;
    font-size:16px;
}

tbody tr{
    border-bottom:1px solid #eee;
    transition:0.3s;
}

tbody tr:hover{
    background:#f8fbff;
}

tbody td{
    padding:18px;
    text-align:center;
    color:#333;
    font-size:15px;
}

/* ===== STATUS ===== */

.status{
    padding:8px 15px;
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

/* ===== BUTTONS ===== */

.action-btn{
    border:none;
    padding:10px 16px;
    border-radius:8px;
    color:white;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
    margin:3px;
}

.btn-accept{
    background:#10b981;
}

.btn-accept:hover{
    background:#059669;
}

.btn-refuse{
    background:#ef4444;
}

.btn-refuse:hover{
    background:#dc2626;
}

.btn-delete{
    background:#6b7280;
}

.btn-delete:hover{
    background:#374151;
}

/* ===== RESPONSIVE ===== */

@media(max-width:900px){

    .nav-content{
        flex-direction:column;
        text-align:center;
    }

    .nav-links{
        flex-wrap:wrap;
        justify-content:center;
    }

    table{
        width:95%;
    }

    thead{
        display:none;
    }

    table,
    tbody,
    tr,
    td{
        display:block;
        width:100%;
    }

    tr{
        margin-bottom:20px;
        border-radius:12px;
        overflow:hidden;
        background:white;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
    }

    td{
        text-align:right;
        padding-left:50%;
        position:relative;
        border-bottom:1px solid #eee;
    }

    td::before{
        content:attr(data-label);
        position:absolute;
        left:15px;
        width:45%;
        text-align:left;
        font-weight:bold;
        color:#1e3a5f;
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
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

        @foreach($infirmiers as $infirmier)

            <tr>

                <td>
                    {{ $infirmier->user->nom }}
                    {{ $infirmier->user->prenom }}
                </td>

                <td>
                    {{ $infirmier->user->email }}
                </td>

                <td>
                    {{ $infirmier->specialite }}
                </td>

                <td>
                    {{ $infirmier->experience }} ans
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