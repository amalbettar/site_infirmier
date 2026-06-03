<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>{{ __('admin_infirmiers_title') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/liste_compte.css') }}">
</head>

<body>

<nav class="navbar">

    <div class="nav-content">

        <a href="#" class="logo">
            <i class="fa-solid fa-hand-holding-droplet"></i>
            {{ __('site_name') }}
        </a>

        <div class="nav-links">

            <a href="{{ route('admin.infirmiers') }}">{{ __('list_nurses') }}</a>
            <a href="{{ route('dashboard') }}">{{ __('dashboard') }}</a>

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

<h1>{{ __('nurses_validation') }}</h1>

@if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

<table border="1" width="100%">

    <thead>
        <tr>
            <th>{{ __('name') }}</th>
            <th>{{ __('email') }}</th>
            <th>{{ __('speciality') }}</th>
            <th>{{ __('experience') }}</th>
            <th>{{ __('city') }}</th>
            <th>{{ __('address') }}</th>
            <th>{{ __('status') }}</th>
            <th>{{ __('actions') }}</th>
        </tr>
    </thead>

    <tbody>

        @foreach($infirmiers as $infirmier)

        <tr>

            <td>
                {{ ucfirst($infirmier->user->nom) }}
                {{ ucfirst($infirmier->user->prenom) }}
            </td>

            <td>{{ $infirmier->user->email }}</td>
            <td>{{ $infirmier->specialite }}</td>
            <td>{{ $infirmier->experience }} {{ __('ans') }}</td>
            <td>{{ $infirmier->user->ville }}</td>
            <td>{{ $infirmier->user->adresse }}</td>

            <td>
                @if($infirmier->validation == 'en_attente')
                    <span class="status en_attente">{{ $infirmier->validation}}</span>

                @elseif($infirmier->validation == 'accepte')
                    <span class="status accepte">{{ $infirmier->validation }}</span>

                @else
                    <span class="status refuse">{{ $infirmier->validation }}</span>
                @endif
            </td>

            <td > 

                @if($infirmier->validation === 'en_attente')

                    <form  action="{{ route('admin.infirmiers.accepter', $infirmier->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="action-btn btn-accept">{{ __('accept') }}</button>
                    </form>

                    <form action="{{ route('admin.infirmiers.refuser', $infirmier->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="action-btn btn-refuse">{{ __('refuse') }}</button>
                    </form>

                @else

                    <form action="{{ route('admin.infirmiers.refuser', $infirmier->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="action-btn btn-delete">{{ __('delete_account') }}</button>
                    </form>

                @endif

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

</body>
</html>