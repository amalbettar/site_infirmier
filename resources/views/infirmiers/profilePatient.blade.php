<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/profil.css') }}">
</head>

<body>

    <!-- NAVBAR -->
    
    <nav class="navbar">
        <div class="container nav-content">

            <a href="#" class="logo">
                <i class="fa-solid fa-hand-holding-droplet"></i>
                Infirmières à Domicile
            </a>

            <div class="nav-links">
                <a href="{{ route('home') }}"></i>Accueil</a>
            
            <a href="{{ route('rechercher') }}">Rechercher des infirmiers</a>
            @auth
            <a href="{{ route('profile_patient.index') }}"><i class="fa-solid fa-user"></i></a>
            @endauth
            </div>

            <div class="user-box">
                <span class="user-name">
                    Bonjour, {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn-logout">Déconnexion</button>
                </form>
            </div>

        </div>
    </nav>

    <!-- CONTENT -->
    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- SUCCESS -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="profile-card">

                    <!-- PHOTO -->
                    <div class="text-center mb-4">
                        <img id="preview" src="{{ asset($infos->photo) }}" class="profile-image">

                        <h2 class="mt-3">
                            {{ucfirst($infos->nom)  }} {{ucfirst($infos->prenom)  }}
                        </h2>

                        <p class="text-muted">Profil Patient</p>
                    </div>

                    <!-- FORM -->
                    <form action="{{ route('profile_patient.update') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- PHOTO -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Photo</label>
                                <input type="file" name="photo" class="form-control">
                                <button type="submit" name="field" value="photo">Changer</button>
                            </div>

                            <!-- EMAIL -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $infos->email) }}">
                                <button type="submit" name="field" value="email">Changer</button>
                            </div>

                            <!-- NOM -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom</label>
                                <input type="text" class="form-control readonly" value="{{ $infos->nom }}" disabled>
                            </div>

                            <!-- PRENOM -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prenom</label>
                                <input type="text" class="form-control readonly" value="{{ $infos->prenom }}" disabled>
                            </div>

                            <!-- TELEPHONE -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Téléphone</label>
                                <input type="text" name="telephone" class="form-control"
                                    value="{{ old('telephone', $infos->telephone) }}">
                                <button type="submit" name="field" value="telephone">Changer</button>
                            </div>

                            

                            <!-- VILLE -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ville</label>
                                <input type="text" class="form-control readonly" value="{{ $infos->ville }}" disabled>
                            </div>

                            <!-- ADRESSE -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Adresse</label>
                                <input type="text" class="form-control readonly" value="{{ $infos->adresse }}" disabled>
                            </div>


                        </div>

                        <hr>

                        <!-- PASSWORD -->
                        <h4 class="section-title">Changer Mot de Passe</h4>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nouveau mot de passe</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>

                        </div>

                        <div class="text-center mt-4">
                            <button class="btn-save" name="field" value="password" type="submit">
                                Enregistrer
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>


    </div>
    

</body>

</html>