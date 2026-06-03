<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styles/reset.css') }}">
</head>
<body>

    <div class="reset-card">

        <div class="icon">
            <i class="fa-solid fa-key"></i>
        </div>

        <div class="title">
            <h2>Nouveau mot de passe</h2>
            <p>Choisissez un nouveau mot de passe sécurisé.</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                required
                autofocus
                autocomplete="username"
                placeholder="Votre email"
            >
            @error('email')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <label for="password">Nouveau mot de passe</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Nouveau mot de passe"
            >
            @error('password')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Confirmer le mot de passe"
            >
            @error('password_confirmation')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <button type="submit">
                <i class="fa-solid fa-rotate-right"></i>
                Réinitialiser le mot de passe
            </button>

            <a href="{{ route('login') }}">
                <i class="fa-solid fa-arrow-left"></i>
                Retour à la connexion
            </a>

        </form>

    </div>

</body>
</html>