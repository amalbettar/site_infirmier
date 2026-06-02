<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Infirmier</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/register.css') }}">
</head>
<body>

<div class="container">

    <h2><span class="imoji"><i class="fa-solid fa-user-injured"></i></span> Inscription {{ucfirst($role)  }} </h2>

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
        @error('email')
            <span class="text-red-500 text-sm">
                {{ $message }}
            </span>
        @enderror

        <div class="form-group">
            <label>Téléphone</label>
            <input type="text" name="telephone">
            @error('telephone')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror
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

            @error('password')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label>Confirmer mot de passe</label>
            <input type="password" name="password_confirmation" required>

            @error('password_confirmation')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <a href="{{ route('login') }}">vous avez deja un compte ? </a>

        <button type="submit">
            S'inscrire
        </button>

    </form>

</div>

</body>
</html>