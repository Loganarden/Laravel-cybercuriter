<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"> 

    <title>login</title>

    @yield('css')

</head>
<body>

    <div class="nav">
    <li style="float:right"><a href="/connexion">Connexion</a></li>
    <li style="float:right"><a href="/inscription">Inscription/a></li>
    </div>

    <div class="contenu">

        @yield('contenu')
    
    </div>
    
</body>
</html>