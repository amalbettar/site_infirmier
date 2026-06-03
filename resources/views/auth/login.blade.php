<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('login.title') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/login.css') }}">
</head>

<body>

<div class="login-card">

    <div class="emoji">
        <i class="fa-solid fa-hand-holding-medical"></i>
    </div>

    <a href="{{ url('lang/fr') }}">FR</a>
    <a href="{{ url('lang/ar') }}">AR</a>

    <div class="title">
        <h2>{{ __('login.hello') }}</h2>
        <p>{{ __('login.subtitle') }}</p>
    </div>

    <form action="{{ route('login.post') }}" method="post">
        @csrf

        <label>{{ __('login.email') }}</label>
        <input type="email" name="email" placeholder="{{ __('login.email_placeholder') }}">

        @error('email')
            <span class="error-text">{{ $message }}</span>
        @enderror

        <label>{{ __('login.password') }}</label>
        <input type="password" name="password" placeholder="{{ __('login.password_placeholder') }}">

        @error('password')
            <span class="error-text">{{ $message }}</span>
        @enderror

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                {{ __('login.forgot_password') }}
            </a>
        @endif

        <br>

        <a href="{{ route('role') }}">
            {{ __('login.no_account') }}
        </a>

        <button type="submit">
            {{ __('login.login_btn') }}
        </button>
    </form>

</div>

</body>
</html>