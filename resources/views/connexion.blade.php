@extends ('layout')

    @section('css')

    @endsection
    
    @section ('contenu')

        <div>
            Connexion
        </div>

        <div>
            <fieldset>
                <form action="api/connexion" method="post">
                {{ csrf_field() }}

                    <p><input type="email" name="email" id="email" placeholder="Email"></p>
                        @if($errors->has('email'))
                        <p>{{ $errors->first ('email') }}</p>
                        @endif

                    <p><input type="password" name="password" id="password" placeholder="Mot de passe"></p>
                        @if($errors->has('password'))
                        <p>{{ $errors->first ('password') }}</p>
                        @endif

                    <p><input type="submit" value="Se connecter"></p>
                </form>
            </fieldset>
        </div>


    @endsection