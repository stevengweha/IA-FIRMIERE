<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- HEADER -->
    <header class="bg-success text-white p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h2>IA-FIRMIERE</h2>
            <div>
                <a href="{{ route('home', ['form' => 'login']) }}" class="btn btn-outline-light me-2">Connexion</a>
                <a href="{{ route('home', ['form' => 'register']) }}" class="btn btn-outline-light">Inscription</a>
                <a href="{{ route('home', ['form' => 'logout']) }}" class="btn btn-outline-light">deconnexion</a>

            </div>
        </div>
    </header>

    <!-- AFFICHAGE DU FORMULAIRE -->
    @if (!isset($formType))
    <p>Erreur : aucun type de formulaire défini</p>
@elseif ($formType === 'login')
    <p class="text-center">Veillez vous connecter</p>  <!---Affichage du formulaire de login--->
    @include('auth.login')
@else
    <p class="text-center">inscription</p> <!---Affichage du formulaire d'inscription--->
    @include('auth.register')
@endif

</body>
</html>
