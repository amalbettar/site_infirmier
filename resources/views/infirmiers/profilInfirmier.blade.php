<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <!-- Bootstrap (IMPORTANT) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            margin: 0;
            padding: 0;
            font-size: 16px;
            color: #333;
        }

        .navbar {
            background: #0d6efd;
            padding: 15px 0;
            width: 100%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-links a {
            color: white;
            font-size: 16px;
            text-decoration: none;
            transition: 0.3s;
            font-weight: bolder;
        }

        .nav-links a:hover {
            color: #dbeafe;
        }

        .btn-login {
            background: white;
            color: #0d6efd !important;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
        }

        /* User Box */

        .user-box {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(255, 255, 255, 0.15);
            padding: 8px 15px;
            border-radius: 10px;
        }

        .user-name {
            color: white;
            font-weight: bold;
            font-size: 15px;
        }

        .btn-logout {
            background: #492dbb;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #dc3545;
        }

        /* ===== NAVBAR ===== */


        /* ===== PROFILE CARD ===== */
        .profile-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        /* IMAGE */
        .profile-image {
            display: block;
            margin: 0 auto;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #0d6efd;
        }

        /* FORM */
        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            padding: 12px;
            border-radius: 8px;
        }

        .readonly {
            background: #f1f1f1;
        }

        /* ERROR */
        .error-text {
            color: red;
            font-size: 12px;
        }

        /* BUTTONS */
        button[type="submit"] {
            margin-top: 8px;
            background: #0d6efd;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
        }

        .btn-save {
            background: #198754;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            border: none;
        }

        /* TITLE */
        .section-title {
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
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
                            {{ $infos->nom }} {{ $infos->prenom }}
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