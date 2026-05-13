<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Infirmier</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f7fa;
            margin:0;
            padding:0;
        }

        .container{
            width:500px;
            margin:40px auto;
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

        h2{
            text-align:center;
            margin-bottom:25px;
            color:#1e88e5;
        }

        .form-group{
            margin-bottom:15px;
        }

        label{
            display:block;
            margin-bottom:5px;
            font-weight:bold;
        }

        input,
        select,
        textarea{
            width:100%;
            padding:10px;
            border:1px solid #ccc;
            border-radius:5px;
        }

        textarea{
            resize:none;
            height:100px;
        }

        button{
            width:100%;
            padding:12px;
            background:#1e88e5;
            color:white;
            border:none;
            border-radius:5px;
            font-size:16px;
            cursor:pointer;
        }

        button:hover{
            background:#1565c0;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Inscription {{ $role }} </h2>

    <form action="{{ route("inscription.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="role" value="{{ $role }}"/>

        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="nom" required>
        </div>

        <div class="form-group">
            <label>Prénom</label>
            <input type="text" name="prenom" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>


        <div class="form-group">
            <label>Téléphone</label>
            <input type="text" name="telephone">
        </div>

        <div class="form-group">
            <label>Adresse</label>
            <input type="text" name="adresse">
        </div>

        <div class="form-group">
            <label>Ville</label>
            <input type="text" name="ville">
        </div>

        <div class="form-group">
            <label>Photo</label>
            <input type="file" name="photo">
        </div>

        @if ($role==='infirmier')
        <div class="form-group">
            <label>Spécialité</label>

            <select name="specialite">
                <option value="Soins à domicile">Soins à domicile</option>
                <option value="Pédiatrie">Pédiatrie</option>
                <option value="Urgence">Urgence</option>
                <option value="Gériatrie">Gériatrie</option>
            </select>
        </div>

        <div class="form-group">
            <label>Expérience (années)</label>
            <input type="number" name="experience">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description"></textarea>
        </div>
        @endif
        

        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-group">
            <label>Confirmer mot de passe</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit">
            S'inscrire
        </button>

    </form>

</div>

</body>
</html>