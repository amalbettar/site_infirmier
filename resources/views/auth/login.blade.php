<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/login.css') }}">
</head>
<body>

    <div class="login-card">

        <div class="emoji"><i class="fa-solid fa-hand-holding-medical"></i></div>

        <div class="title">
            <h2>Bonjour !</h2>
            <p>Connectez-vous à votre compte</p>
        </div>

        <form action="{{ route('login.post') }}" method="post">
            @csrf

            <label>Email</label>
            <input type="email" name="email" placeholder="Entrez votre email">

            @error('email')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <label>Mot de Passe</label>
            <input type="password" name="password" placeholder="Entrez votre mot de passe">

            @error('password')
                <span class="error-text">{{ $message }}</span>
            @enderror

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
            <br>
            <a href="{{ route('role') }}">
                    Vous n'avez pas un compte ? 
                </a>

            <button type="submit">
                Se connecter
            </button>
        </form>

    </div>

</body>
</html>