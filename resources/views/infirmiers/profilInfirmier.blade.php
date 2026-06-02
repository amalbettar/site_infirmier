<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <!-- Bootstrap (IMPORTANT) -->
    <link rel="stylesheet" href="{{ asset('styles/profil.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


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
                <a href="{{ route('rv.infirmier') }}">Rendez-vous</a>
                <a href="{{ route('disponibilites.index') }}">Disponibilités</a>
                <a href="{{ route('profile.index') }}">Profile</a>
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
                            {{ucfirst($infos->nom)  }} {{ucfirst($infos->prenom) }}
                        </h2>

                        <p class="text-muted">Profil Infirmier</p>
                    </div>

                    <!-- FORM -->
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">

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

                            <!-- disponnibilite -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Disponibilité</label>

                                <select class="form-control" name="status">

                                    <option value="Disponnible" {{ $infos->infirmier->status == 'Disponnible' ? 'selected' : '' }}>
                                        Disponible
                                    </option>

                                    <option value="Occupé" {{ $infos->infirmier->status == 'Occupé' ? 'selected' : '' }}>
                                        Occupé
                                    </option>


                                </select>
                                <button type="submit" name="field" value="status">Changer</button>
                            </div>

                            <!-- TELEPHONE -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Téléphone</label>
                                <input type="text" name="telephone" class="form-control"
                                    value="{{ old('telephone', $infos->telephone) }}">
                                <button type="submit" name="field" value="telephone">Changer</button>
                            </div>

                            <!-- SPECIALITE -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Spécialité</label>
                                <input type="text" name="specialite" class="form-control"
                                    value="{{ old('specialite', $infos->infirmier->specialite) }}">
                                <button type="submit" name="field" value="specialite">Changer</button>
                            </div>

                            <!-- EXPERIENCE -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Expérience</label>
                                <input type="number" name="experience" class="form-control"
                                    value="{{ old('experience', $infos->infirmier->experience) }}">
                                <button type="submit" name="field" value="experience">Changer</button>
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

                            <!-- DESCRIPTION -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4">
                                    {{ old('description', $infos->infirmier->description) }}
                                </textarea>
                                <button type="submit" name="field" value="description">Changer</button>
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
    <div class="profil-container">



        <!-- AFFICHAGE AVIS -->

        <div class="avis-list">

            <h2>Commentaires des patients</h2>

            @foreach($avis as $avi)

                <div class="card">

                    <b>

                        {{ $avi->patient->user->nom }}

                    </b>

                    <p>

                        {{ $avi->commentaire }}

                    </p>

                    <p>

                        ⭐ {{ $avi->note }}/5

                    </p>

                    @if(auth()->user()->role == "infirmier")

                        <form action="/avis/{{$avi->id}}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button class="delete-btn" onclick="return confirm('Supprimer cet avis ?')">

                                Supprimer

                            </button>

                        </form>

                    @endif

                </div>

            @endforeach

        </div>

    </div>

</body>

</html>