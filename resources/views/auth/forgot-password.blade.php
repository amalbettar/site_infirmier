<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styles/login.css') }}">
</head>
<body>
    <div class="login-card">

        <div class="emoji">
            <i class="fa-solid fa-lock"></i>
        </div>

        <div class="title">
            <h2>Mot de passe oublié ?</h2>
            <p>Entrez votre email pour recevoir un lien de réinitialisation.</p>
        </div>

        @if (session('status'))
            <div style="background:#EAF3DE;color:#27500A;border:0.5px solid #C0DD97;padding:12px 16px;border-radius:10px;font-size:14px;margin-bottom:16px;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Entrez votre email">

            @error('email')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <button type="submit">
                Envoyer le lien
            </button>

            <a href="{{ route('login') }}">Retour à la connexion</a>
        </form>

    </div>
</body>
</html>