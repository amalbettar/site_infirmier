<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Statut du rendez-vous</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f7fb; padding:20px;">

    <div style="max-width:600px; margin:auto; background:white; padding:20px; border-radius:10px;">
        <h2  style="color:green;">Status : {{ $etat }}</h2>
        <h2 style="color:#333;">Bonjour {{ $rv->patient->user->prenom }} {{ $rv->patient->user->nom }},</h2>

        
            <p style="color:green; font-size:16px;">
                ✅ Votre rendez-vous a été <strong>accepté</strong>.
            </p>

            <p>
                Nous avons le plaisir de vous informer que votre rendez-vous avec l'infirmier 
                {{ucfirst($rv->infirmier->user->nom)  }} {{ucfirst($rv->infirmier->user->prenom)  }}  
                a été confirmé.
            </p>

       

        <hr>

        <p><strong>Détails du rendez-vous :</strong></p>

        <ul>
            <li>Date : {{ $rv->date }}</li>
            <li>Heure de debut : {{ $rv->heure_debut }}</li>
            <li>Heure du fin: {{ $rv->heure_fin }}</li>
        </ul>

        <br>

        <p style="font-size:12px; color:gray;">
            Merci pour votre confiance.
        </p>

    </div>

</body>
</html>