<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>{{ __('title_home') }}</title>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('styles/welcome.css') }}">
</head>

<body>

<nav class="navbar">

    <div class="container nav-content">

        <a href="#" class="logo">

            <i class="fa-solid fa-hand-holding-droplet"></i>

            {{ __('site_name') }}

        </a>

        <div class="nav-links">

            <a href="{{ route('home') }}">
                {{ __('home') }}
            </a>

            <a href="{{ route('rechercher') }}">
                {{ __('search_nurse') }}
            </a>

            @auth

            <a href="{{ route('rv_patient') }}">
                {{ __('my_appointments') }}
            </a>

            <a href="{{ route('profile_patient.index') }}">
                <i class="fa-solid fa-user"></i>
            </a>

            @endauth

            <a href="{{ url('lang/fr') }}">FR</a>

            <a href="{{ url('lang/ar') }}">AR</a>

            @if(Auth::check())

            <div class="user-box">

                <span class="user-name">

                    {{ __('hello') }},

                    {{ Auth::user()->prenom }}

                    {{ Auth::user()->nom }}

                </span>

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button type="submit" class="btn-logout">

                        {{ __('logout') }}

                    </button>

                </form>

            </div>

            @else

            <a href="/login" class="btn-login">

                {{ __('login') }}

            </a>

            <a href="/role" class="btn-login">

                {{ __('register') }}

            </a>

            @endif

        </div>

    </div>

</nav>

<section class="hero">

    <div class="container">

        <div class="hero-content">

            <h1>{{ __('hero_title') }}</h1>

            <p>{{ __('hero_text') }}</p>

            <div class="hero-buttons">

                <a href="{{ route('rechercher') }}"
                class="btn btn-primary">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    {{ __('search_nurse_btn') }}

                </a>

                <a href="#services" class="btn btn-outline">

                    {{ __('our_services') }}

                </a>

            </div>

        </div>

    </div>

</section>

<section id="services">

    <div class="container">

        <h2 class="section-title">

            {{ __('our_services') }}

        </h2>

        <div class="services-grid">

            @foreach ($service as $s)

            <div class="service-card">

                <i class="fa-solid fa-user-nurse"></i>

                <h3>{{ __($s) }}</h3>

            </div>

            @endforeach

        </div>

    </div>

</section>

<section class="bg-light" id="about">

    <div class="container">

        <h2 class="section-title">

            {{ __('why_choose_us') }}

        </h2>

        <div class="about-grid">

            <div class="about-box">

                <i class="fa-solid fa-circle-check"></i>

                <h4>{{ __('professional') }}</h4>

            </div>

            <div class="about-box">

                <i class="fa-solid fa-clock"></i>

                <h4>{{ __('available24') }}</h4>

            </div>

            <div class="about-box">

                <i class="fa-solid fa-truck-medical"></i>

                <h4>{{ __('fast_intervention') }}</h4>

            </div>

            <div class="about-box">

                <i class="fa-solid fa-notes-medical"></i>

                <h4>{{ __('medical_followup') }}</h4>

            </div>

        </div>

    </div>

</section>

<section>

    <div class="container">

        <h2 class="section-title">

            {{ __('how_it_works') }}

        </h2>

        <div class="steps-grid">

            <div class="step-box">

                <h1>1️⃣</h1>

                <h4>{{ __('step1') }}</h4>

            </div>

            <div class="step-box">

                <h1>2️⃣</h1>

                <h4>{{ __('step2') }}</h4>

            </div>

            <div class="step-box">

                <h1>3️⃣</h1>

                <h4>{{ __('step3') }}</h4>

            </div>

        </div>

    </div>

</section>

<section class="stats">

    <div class="container">

        <div class="stats-grid">

            <div class="stats-box">

                <h1>{{ $nb_patient }}</h1>

                <p>{{ __('patients') }}</p>

            </div>

            <div class="stats-box">

                <h1>{{ $nb_infirmier }}</h1>

                <p>{{ __('nurses') }}</p>

            </div>

        </div>

    </div>

</section>

<footer>

    <div class="container">

        <p>

            © 2026 {{ __('footer_text') }}

        </p>

    </div>

</footer>

</body>
</html>