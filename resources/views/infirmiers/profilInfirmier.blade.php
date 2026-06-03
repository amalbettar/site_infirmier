<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>{{ __('profile_title') }}</title>

    <link rel="stylesheet" href="{{ asset('styles/profil.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<nav class="navbar">

    <div class="container nav-content">

        <a href="#" class="logo">
            <i class="fa-solid fa-hand-holding-droplet"></i>
            {{ __('site_name') }}
        </a>

        <div class="nav-links">
            <a href="{{ route('rv.infirmier') }}">{{ __('appointments') }}</a>
            <a href="{{ route('disponibilites.index') }}">{{ __('availability') }}</a>
            <a href="{{ route('profile.index') }}">{{ __('profile') }}</a>
            <a href="{{ url('lang/fr') }}">FR</a>

            <a href="{{ url('lang/ar') }}">AR</a>
        </div>

        <div class="user-box">

            <span class="user-name">
                {{ __('hello') }},
                {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn-logout">{{ __('logout') }}</button>
            </form>

        </div>

    </div>

</nav>

<div class="container py-5">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-card">

        <div class="text-center mb-4">

            <img src="{{ asset($infos->photo) }}" class="profile-image">

            <h2>{{ ucfirst($infos->nom) }} {{ ucfirst($infos->prenom) }}</h2>

            <p>{{ __('infirmier_profile') }}</p>

        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">

                <!-- PHOTO -->
                <div class="col-md-6 mb-3">
                    <label>{{ __('photo') }}</label>
                    <input type="file" name="photo">
                    <button type="submit" name="field" value="photo">{{ __('change') }}</button>
                </div>

                <!-- EMAIL -->
                <div class="col-md-6 mb-3">
                    <label>{{ __('email') }}</label>
                    <input type="email" name="email" value="{{ $infos->email }}">
                    <button type="submit" name="field" value="email">{{ __('change') }}</button>
                </div>

                <!-- NOM -->
                <div class="col-md-6 mb-3">
                    <label>{{ __('last_name') }}</label>
                    <input disabled value="{{ $infos->nom }}">
                </div>

                <!-- PRENOM -->
                <div class="col-md-6 mb-3">
                    <label>{{ __('first_name') }}</label>
                    <input disabled value="{{ $infos->prenom }}">
                </div>

                <!-- STATUS -->
                <div class="col-md-6 mb-3">
                    <label>{{ __('availability_status') }}</label>

                    <select name="status">

                        <option value="Disponnible">{{ __('available') }}</option>
                        <option value="Occupé">{{ __('busy') }}</option>

                    </select>

                    <button type="submit" name="field" value="status">{{ __('change') }}</button>
                </div>

                <!-- PHONE -->
                <div class="col-md-6 mb-3">
                    <label>{{ __('phone') }}</label>
                    <input type="text" name="telephone" value="{{ $infos->telephone }}">
                    <button type="submit" name="field" value="telephone">{{ __('change') }}</button>
                </div>

                <!-- SPECIALITY -->
                <div class="col-md-6 mb-3">
                    <label>{{ __('speciality') }}</label>
                    <input type="text" name="specialite" value="{{ $infos->infirmier->specialite }}">
                    <button type="submit" name="field" value="specialite">{{ __('change') }}</button>
                </div>

                <!-- EXPERIENCE -->
                <div class="col-md-6 mb-3">
                    <label>{{ __('experience') }}</label>
                    <input type="number" name="experience" value="{{ $infos->infirmier->experience }}">
                    <button type="submit" name="field" value="experience">{{ __('change') }}</button>
                </div>

                <!-- CITY -->
                <div class="col-md-6 mb-3">
                    <label>{{ __('city') }}</label>
                    <input disabled value="{{ $infos->ville }}">
                </div>

                <!-- ADDRESS -->
                <div class="col-12 mb-3">
                    <label>{{ __('address') }}</label>
                    <input disabled value="{{ $infos->adresse }}">
                </div>

                <!-- DESCRIPTION -->
                <div class="col-12 mb-3">
                    <label>{{ __('description') }}</label>
                    <textarea name="description">{{ $infos->infirmier->description }}</textarea>
                    <button type="submit" name="field" value="description">{{ __('change') }}</button>
                </div>

            </div>

            <hr>

            <h4>{{ __('change_password') }}</h4>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>{{ __('new_password') }}</label>
                    <input type="password" name="password">
                </div>

                <div class="col-md-6 mb-3">
                    <label>{{ __('confirm_password') }}</label>
                    <input type="password" name="password_confirmation">
                </div>

            </div>

            <button class="btn-save" name="field" value="password">
                {{ __('save') }}
            </button>

        </form>

    </div>

</div>

<!-- REVIEWS -->

<div class="avis-list">

    <h2>{{ __('patient_reviews') }}</h2>

    @foreach($avis as $avi)

    <div class="card">

        <b>{{ $avi->patient->user->nom }}</b>

        <p>{{ $avi->commentaire }}</p>

        <p>⭐ {{ $avi->note }}/5</p>

        @if(auth()->user()->role == "infirmier")

        <form action="/avis/{{$avi->id}}" method="POST">
            @csrf
            @method('DELETE')

            <button onclick="return confirm('{{ __('delete_confirm') }}')">
                {{ __('delete') }}
            </button>

        </form>

        @endif

    </div>

    @endforeach

</div>

</body>
</html>