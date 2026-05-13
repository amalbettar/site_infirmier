<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir un rôle</title>

  

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        body{
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: #f3f4f6;
}

.container{
    max-width: 1100px;
    margin: auto;
    padding: 60px 20px;
}

.title-box{
    text-align: center;
    margin-bottom: 50px;
}

.title-box h1{
    font-size: 40px;
    color: #1f2937;
    margin-bottom: 10px;
}

.title-box p{
    color: #6b7280;
    font-size: 18px;
}

.cards{
    display: flex;
    gap: 30px;
    justify-content: center;
    flex-wrap: wrap;
}

.role-card{
    background: white;
    width: 350px;
    padding: 35px;
    border-radius: 25px;
    text-decoration: none;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.role-card:hover{
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.icon-box{
    width: 90px;
    height: 90px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: auto;
    font-size: 40px;
    margin-bottom: 25px;
}

.doctor{
    background: #dbeafe;
    color: #2563eb;
}

.patient{
    background: #dcfce7;
    color: #16a34a;
}

.role-title{
    text-align: center;
    font-size: 28px;
    margin-bottom: 20px;
}

.blue{
    color: #2563eb;
}

.green{
    color: #16a34a;
}

.role-text{
    text-align: center;
    color: #4b5563;
    line-height: 1.7;
    margin-bottom: 30px;
}

.text-center{
    text-align: center;
}

.btn-role{
    display: inline-block;
    padding: 12px 28px;
    border-radius: 12px;
    color: white;
    font-weight: bold;
}

.btn-blue{
    background: #2563eb;
}

.btn-green{
    background: #16a34a;
}

.btn-blue:hover{
    background: #1d4ed8;
}

.btn-green:hover{
    background: #15803d;
}

    </style>
</head>

<body>

    <div class="container">

        {{-- Title --}}
        <div class="title-box">

            <h1>
                Choisissez votre rôle
            </h1>

            <p>
                Sélectionnez votre espace pour continuer
            </p>

        </div>

        {{-- Cards --}}
        <div class="cards">

            {{-- Card Infirmier --}}
            <a href="{{ route('inscrire','infirmier') }}"
               class="role-card">

                <div class="icon-box doctor">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>

                <h2 class="role-title blue">
                    Infirmier
                </h2>

                <p class="role-text">
                    Rejoignez notre plateforme en tant qu’infirmier
                    et proposez vos soins à domicile aux patients.
                </p>

                <div class="text-center">
                    <span class="btn-role btn-blue">
                        S'inscrire
                    </span>
                </div>

            </a>

            {{-- Card Patient --}}
            <a href="{{ route('inscrire','patient') }}"
               class="role-card">

                <div class="icon-box patient">
                    <i class="fa-solid fa-user"></i>
                </div>

                <h2 class="role-title green">
                    Patient
                </h2>

                <p class="role-text">
                    Créez votre compte patient et trouvez rapidement
                    un infirmier qualifié près de chez vous.
                </p>

                <div class="text-center">
                    <span class="btn-role btn-green">
                        Commencer
                    </span>
                </div>

            </a>

        </div>

    </div>

</body>
</html>