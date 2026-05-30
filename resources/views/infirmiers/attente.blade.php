<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Compte en attente</title>

    <style>

        body{
            font-family: Arial;
            background:#f4f7fa;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .box{
            background:white;
            padding:40px;
            border-radius:10px;
            text-align:center;
            width:450px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

        h2{
            color:#ff9800;
        }

        p{
            color:#555;
            margin-top:15px;
        }

        a{
            display:inline-block;
            margin-top:20px;
            text-decoration:none;
            background:#1e88e5;
            color:white;
            padding:10px 20px;
            border-radius:5px;
        }

    </style>
</head>
<body>

<div class="box">


<h2>Statut du compte</h2>

@if(session('status') === 'en_attente')

    <p style="color:orange">
        Votre compte est en attente de validation par l’administrateur.
    </p>

@elseif(session('status') === 'refuse')

    <p style="color:red">
        Désolé. Votre compte a été refusé par l’administrateur.
    </p>

@else

    <p>
        Statut inconnu.
    </p>

@endif

<a href="{{ route('home') }}">
    Retour à l'accueil
</a>

</div>

</body>
</html>