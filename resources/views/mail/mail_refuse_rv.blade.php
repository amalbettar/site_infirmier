
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Statut du rendez-vous</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f7fb; padding:20px;">

    <div style="max-width:600px; margin:auto; background:white; padding:20px; border-radius:10px;">
        <h2  style="color:red;">Status : {{ $etat }}</h2>
        <h2 style="color:#333;">Bonjour {{ $rv->patient->user->prenom }} {{ $rv->patient->user->nom }},</h2>

            
            <p style="color:red; font-size:16px;">
                ❌ Votre rendez-vous avec l'infirmier 
                {{ucfirst($rv->infirmier->user->nom)  }} {{ucfirst($rv->infirmier->user->prenom)  }},  
                dans la date <strong>{{ $rv->date }}</strong> à l'heure : <strong>{{ $rv->heure_debut }}</strong> 
                jusqu'à <strong>{{ $rv->heure_fin }}</strong> 
                a été <strong>refusé</strong>.
            </p>

            <p>
                Nous sommes désolés, votre rendez-vous n’a pas pu être accepté. Veuillez essayer de réserver un autre créneau.
            </p>
        <hr>

        

    </div>

</body>
</html>