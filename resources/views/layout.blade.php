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
    <li style="float:right"><a href="/inscription">Inscription</a></li>

    @else

    <li style="float:right"><a href="/connexion">Connexion</a></li>
    <li style="float:right"><a href="/inscription">Inscription</a></li>

    @endif
    </div>

        @yield('contenu')
    
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</body>
</html>