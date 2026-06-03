<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('register.title') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/register.css') }}">
</head>

<body>

<div class="container">

    <h2>
        <span class="imoji"><i class="fa-solid fa-user-injured"></i></span>
        {{ __('register.title') }} {{ ucfirst($role) }}
    </h2>

    <a href="{{ url('lang/fr') }}">FR</a>
    <a href="{{ url('lang/ar') }}">AR</a>

    <form action="{{ route('inscription.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="role" value="{{ $role }}"/>

        <div class="form-group">
            <label>{{ __('register.nom') }}</label>
            <input type="text" name="nom" required>
        </div>

        <div class="form-group">
            <label>{{ __('register.prenom') }}</label>
            <input type="text" name="prenom" required>
        </div>

        <div class="form-group">
            <label>{{ __('register.email') }}</label>
            <input type="email" name="email" required>
        </div>

        @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label>{{ __('register.telephone') }}</label>
            <input type="text" name="telephone">
        </div>

        <div class="form-group">
            <label>{{ __('register.adresse') }}</label>
            <input type="text" name="adresse">
        </div>

        <div class="form-group">
            <label>{{ __('register.ville') }}</label>
            <input type="text" name="ville">
        </div>

        <div class="form-group">
            <label>{{ __('register.photo') }}</label>
            <input type="file" name="photo">
        </div>

        @if ($role === 'infirmier')

        <div class="form-group">
            <label>{{ __('register.specialite') }}</label>

            <select name="specialite">
                <option value="soins_domicile">{{ __('register.soins_domicile') }}</option>
                <option value="pediatrie">{{ __('register.pediatrie') }}</option>
                <option value="urgence">{{ __('register.urgence') }}</option>
                <option value="geriatrie">{{ __('register.geriatrie') }}</option>
            </select>
        </div>

        <div class="form-group">
            <label>{{ __('register.experience') }}</label>
            <input type="number" name="experience">
        </div>

        <div class="form-group">
            <label>{{ __('register.description') }}</label>
            <textarea name="description"></textarea>
        </div>

        @endif

        <div class="form-group">
            <label>{{ __('register.password') }}</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-group">
            <label>{{ __('register.confirm_password') }}</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <a href="{{ route('login') }}">
            {{ __('register.already_account') }}
        </a>

        <button type="submit">
            {{ __('register.submit') }}
        </button>

    </form>

</div>

</body>
</html>