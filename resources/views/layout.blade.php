<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"> 

    <title>login</title>

    @yield('css')

</head>
<body>

    <div class="nav">

    @if (auth()->check())

    <li style="float:right"><a href="/deconnexion">deconnexion</a></li>

    @else

    <li style="float:right"><a href="/connexion">Connexion</a></li>

    @endif

    <li style="float:right"><a href="/inscription">Inscription</a></li>
    </div>

    <div class="contenu">

        @yield('contenu')
    
    </div>
    
</body>
</html>