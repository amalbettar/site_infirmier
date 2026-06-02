<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Compte accepté</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f7fb; padding:40px;">

    <div style="
        max-width:600px;
        margin:auto;
        background:white;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 20px rgba(0,0,0,0.1);
    ">
        <h2  style="color:green;">Status : {{ $validation }}</h2>
        <h2 style="color:#185FA5;">
            Bonjour {{ucfirst($user->prenom)  }} {{ucfirst($user->nom)  }},
        </h2>

        <p style="font-size:16px; color:#333;">
            Nous sommes heureux de vous informer que votre compte infirmier
            a été accepté avec succès.
        </p>

        <p style="font-size:16px; color:#333;">
            Vous pouvez maintenant accéder à votre espace et commencer
            à utiliser la plateforme.
        </p>

        <div style="margin-top:30px;">
            <a href="{{ url('/login') }}"
               style="
                    background:#185FA5;
                    color:white;
                    padding:12px 20px;
                    text-decoration:none;
                    border-radius:8px;
                    font-weight:bold;
               ">
                Se connecter
            </a>
        </div>

        <p style="margin-top:40px; color:#777;">
            Merci pour votre confiance.
        </p>

    </div>

</body>
</html>

